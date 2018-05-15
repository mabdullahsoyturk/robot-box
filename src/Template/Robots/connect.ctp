<?php
$this->append("css");
?>

<style>
    .map {
        position: absolute;
        z-index: 1;
    }

    #myContainer {
        display: inline-block;
        width: 400px;
        height: 340px;
        margin: 0 auto;
        position: relative;
    }

    #camContainer{
        display: inline-block;
    }

    #mapCanvas {
        position: relative;
        z-index: 20;
    }
</style>

<?php
$this->end();
?>

<?php
$this->append('script');
?>
<script src="https://code.createjs.com/easeljs-0.8.2.min.js"></script>
<script src="https://static.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
<script src="https://static.robotwebtools.org/ros2djs/current/ros2d.min.js"></script>
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://static.robotwebtools.org/roslibjs/current/roslib.min.js"></script>

<script>
    var ros = new ROSLIB.Ros();
    var mapWidth = 15;
    var mapHeight = 15;
    var mapResolution = 1;
    var mapOriginX = 0;
    var mapOriginY = 0;
    var canvas;
    var context = null;
    var xCoordinateOnRobot = 0;
    var yCoordinateOnRobot = 0;
    var angleOnRobot = 0;
    var xCoordinateOnMap = 0;
    var yCoordinateOnMap = 0;
    var positions = [];
    var radius = 7;
    var sequence = 0;
    var goalExists = false;
    var goalX, goalY;

    $(document).ready(function(){
        canvas = document.getElementById("mapCanvas");
        context = canvas.getContext('2d');
        canvas.addEventListener("mousedown", getCursorPosition, false);

        var viewer = new ROS2D.Viewer({
            divID: 'map',
            width: 400,
            height: 340
        });

        var gridClient = new ROS2D.OccupancyGridClient({
            ros: ros,
            rootObject: viewer.scene
        });

        gridClient.on('change', function () {
            viewer.scaleToDimensions(gridClient.currentGrid.width, gridClient.currentGrid.height);
            viewer.shift(mapOriginX, mapOriginY);
        });

    });

    ros.on('error', function (error) {
        document.getElementById('connecting').style.display = 'none';
        document.getElementById('connected').style.display = 'none';
        document.getElementById('closed').style.display = 'none';
        document.getElementById('error').style.display = 'inline';
        console.log(error);
    });

    ros.on('connection', function () {
        console.log('Connection made!');
        document.getElementById('connecting').style.display = 'none';
        document.getElementById('error').style.display = 'none';
        document.getElementById('closed').style.display = 'none';
        document.getElementById('connected').style.display = 'inline';
    });

    ros.on('close', function () {
        console.log('Connection closed.');
        document.getElementById('connecting').style.display = 'none';
        document.getElementById('connected').style.display = 'none';
        document.getElementById('closed').style.display = 'inline';
    });

    ros.connect('ws://<?= $robot->ip_address ?>:<?= $robot->port ?>');

    var robotTopic = new ROSLIB.Topic({
        ros: ros,
        name: '<?= $robot->topic->name ?>',
        messageType: '<?= $robot->topic->mes_type->name ?>'
    });

    robotTopic.subscribe(function (message) {
        xCoordinateOnRobot = message.<?= $robot->topic->mes_type->x_par ?> - mapOriginX;
        yCoordinateOnRobot = message.<?= $robot->topic->mes_type->y_par ?> - mapOriginY;
        angleOnRobot = quaternionToEuler(message.pose.pose.orientation);
        drawRobot();
    });

    function quaternionToEuler(orientation){
        let w = orientation.w;
        let z = orientation.z;
        let sinus = 2 * w * z;
        let cosinus = 1 - (2 * z * z);
        return Math.atan2(sinus, cosinus);
    }

    function drawRobot(){
        xCoordinateOnMap = calculateXCoordinate();
        yCoordinateOnMap = calculateYCoordinate();

        context.clearRect(0, 0, canvas.width, canvas.height);
        context.beginPath();
        context.arc(xCoordinateOnMap , yCoordinateOnMap, radius, 0, 2 * Math.PI, false);
        context.fillStyle = 'green';
        context.fill();
        context.lineWidth = 2;
        context.strokeStyle = '#003300';
        context.stroke();

        context.beginPath();
        context.moveTo(xCoordinateOnMap, yCoordinateOnMap);
        context.lineTo(xCoordinateOnMap - radius * Math.sin(angleOnRobot - Math.PI / 2), yCoordinateOnMap - radius * Math.cos(angleOnRobot - Math.PI / 2));
        context.stroke();

        if(goalExists){
            context.beginPath();
            context.arc(goalX -3, goalY -3, 3 , 0, 2 * Math.PI, false);
            context.stroke();
            drawPath();
        }


        displayCoordinatesAndAngle();
    }

    function calculateXCoordinate(){
        return (xCoordinateOnRobot / mapResolution) * (canvas.width / mapWidth) - (radius / 2);
    }

    function calculateYCoordinate(){
        return (mapHeight - yCoordinateOnRobot / mapResolution) * (canvas.height / mapHeight) - (radius / 2);
    }

    function displayCoordinatesAndAngle(){
        $("#x_cord").text(xCoordinateOnRobot + mapOriginX);
        $("#y_cord").text(yCoordinateOnRobot + mapOriginY);
        $("#theta").text(angleOnRobot);
    }

    var pathTopic = new ROSLIB.Topic({
        ros: ros,
        name: "/move_base/NavfnROS/plan",
        messageType: 'nav_msgs/Path'
    });

    pathTopic.subscribe(function(message){
        var tempArray = [];
        var poses = message.poses;
        for(var i = 0; i < poses.length; i++){
            var pose = poses[i].pose.position;
            tempArray.push(pose);
        }

        positions = tempArray;
    });

    function drawPath(){
          for(var k = 0; k < positions.length-1; k++){
            context.beginPath();
            context.moveTo(((positions[k].x - mapOriginX) / mapResolution) * (canvas.width / mapWidth) - (radius / 2), (mapHeight - (positions[k].y - mapOriginY) / mapResolution) * (canvas.height / mapHeight) - (radius / 2));
            context.lineTo(((positions[k+1].x - mapOriginX) / mapResolution) * (canvas.width / mapWidth) - (radius / 2), (mapHeight - (positions[k+1].y - mapOriginY) / mapResolution) * (canvas.height / mapHeight) - (radius / 2));
            context.stroke();
          }
    }

    var cameraTopic = new ROSLIB.Topic({
        ros: ros,
        name: '/camera/rgb/image_raw/compressed',
        messageType: 'sensor_msgs/CompressedImage'
    });

    cameraTopic.subscribe(function (message) {
        var image = document.getElementById("cameraImg");
        image.src = "data:image/jpeg;base64," + message.data;
    });

    var mapTopic = new ROSLIB.Topic({
        ros: ros,
        name: "/map_metadata",
        messageType: 'nav_msgs/MapMetaData'
    });

    mapTopic.subscribe(function (message) {
        mapWidth = message.width;
        mapHeight = message.height;
        mapResolution = message.resolution;
        mapOriginX =  message.origin.position.x;
        mapOriginY =  message.origin.position.y;
        mapTopic.unsubscribe();
    });

    var goalResultTopic = new ROSLIB.Topic({
        ros: ros,
        name: "/move_base/result",
        messageType: 'move_base_msgs/MoveBaseActionResult'
    });

    goalResultTopic.subscribe(function(message){
        var status = message.status.status;
        if(status == 3){
          goalExists = false;
        }
    });

    var goalTopic = new ROSLIB.Topic({
      ros : ros,
      name : '/move_base_simple/goal',
      messageType : 'geometry_msgs/PoseStamped'
    });

    goalTopic.subscribe(function (message) {
        goalX = ((message.pose.position.x - mapOriginX) / mapResolution) * (canvas.width / mapWidth);
        goalY = (mapHeight - (message.pose.position.y - mapOriginY) / mapResolution) * (canvas.height / mapHeight);
        goalExists = true;
        drawRobot();
    });

    function getCursorPosition(event) {
        var rect = canvas.getBoundingClientRect();
        var positionX = event.clientX - rect.left;
        var positionY = event.clientY - rect.top;

        sendPoseToRobot(positionX, positionY);
    }

    function sendPoseToRobot(positionX, positionY){
        var poseStamped = new ROSLIB.Message({
          header : {
            seq : sequence,
            stamp : (new Date).getTime(),
            frame_id : "/odom"
          },
          pose : {
            position : new ROSLIB.Vector3({
              x: (positionX * mapWidth * mapResolution / canvas.width) + mapOriginX ,
              y: (-((positionY * mapHeight / canvas.height) - mapHeight)) * mapResolution + mapOriginY,
              z: 0
            }),
            orientation : new ROSLIB.Quaternion()
          }
        });

        sequence++;
        goalTopic.publish(poseStamped);
    }

</script>

<?php $this->end(); ?>

<h1>Iteration 4</h1>
<div>
    <span>X coordinate:</span>
    <span id="x_cord"></span>
    <br>
    <span>Y coordinate:</span>
    <span id="y_cord"></span>
    <br>
    <span>Angle:</span>
    <span id="theta"></span>
    <br>
</div>

<div id="myContainer">
    <div id="map" class="map"></div>
    <canvas id="mapCanvas" width="400" height="340"></canvas>
</div>

<div id="camContainer">
    <img id="cameraImg"/>
</div>

<div id="statusIndicator">
    <p id="connecting">
        Connecting to rosbridge...
    </p>
    <p id="connected" style="color:#00D600; display:none">
        Connected
    </p>
    <p id="error" style="color:#FF0000; display:none">
        Error in the backend!
    </p>
    <p id="closed" style="display:none">
        Connection closed.
    </p>
</div>
