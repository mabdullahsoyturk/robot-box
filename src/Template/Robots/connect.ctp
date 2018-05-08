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
    var defWidth = 15;
    var defHeight = 15;
    var defResolution = 1;
    var originX = 0;
    var originY = 0;
    var canvas = document.getElementById("mapCanvas");
    var context = null;
    var readX = 0;
    var readY = 0;
    var readT = 0;
    var centerX = 0;
    var centerY = 0;
    var obj = [];
    var radius = 7;

    var goalExists = false;
    var goalX, goalY;

    $(document).ready(function(){
        canvas = document.getElementById("mapCanvas");
        canvas.addEventListener("mousedown", getCursorPosition, false);
        radius = 7;
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

    var listener = new ROSLIB.Topic({
        ros: ros,
        name: '<?= $robot->topic->name ?>',
        messageType: '<?= $robot->topic->mes_type->name ?>'
    });

    function quad_to_euler(q){
        let w = q.w;
        let z = q.z;
        let t3 = 2 * w * z;
        let t4 = 1 - (2 * z * z);
        return Math.atan2(t3, t4);
    }

    function draw(){
        if(canvas == null) canvas = document.getElementById("mapCanvas");
        if(context == null) context = canvas.getContext('2d');

        centerX = (readX / defResolution) * (canvas.width / defWidth) - (radius / 2);
        centerY = (defHeight - readY / defResolution) * (canvas.height / defHeight) - (radius / 2);

        context.clearRect(0, 0, canvas.width, canvas.height);
        context.beginPath();
        context.arc(centerX , centerY, radius, 0, 2 * Math.PI, false);
        context.fillStyle = 'green';
        context.fill();
        context.lineWidth = 2;
        context.strokeStyle = '#003300';
        context.stroke();

        context.beginPath();
        context.moveTo(centerX, centerY);
        context.lineTo(centerX - radius * Math.sin(readT - Math.PI / 2), centerY - radius * Math.cos(readT - Math.PI / 2));
        context.stroke();

        if(goalExists){
            context.beginPath();
            context.arc(goalX -3, goalY -3, 3 , 0, 2 * Math.PI, false);
            context.stroke();
            drawPath();
        }


        $("#x_cord").text(readX + originX);
        $("#y_cord").text(readY + originY);
        $("#theta").text(readT);
    }

    var path = new ROSLIB.Topic({
        ros: ros,
        name: "/move_base/NavfnROS/plan",
        messageType: 'nav_msgs/Path'
    });

    path.subscribe(function(message){
        var emptyArr = [];
        var arr = message.poses;
        for(var i = 0; i < arr.length; i++){
            var pose = arr[i].pose.position;
            emptyArr.push(pose);
        }

        obj = emptyArr;
    });

    function drawPath(){
          for(var k = 0; k < obj.length-1; k++){
            context.beginPath();
            context.moveTo(((obj[k].x - originX) / defResolution) * (canvas.width / defWidth) - (radius / 2), (defHeight - (obj[k].y - originY) / defResolution) * (canvas.height / defHeight) - (radius / 2));
            context.lineTo(((obj[k+1].x - originX) / defResolution) * (canvas.width / defWidth) - (radius / 2), (defHeight - (obj[k+1].y - originY) / defResolution) * (canvas.height / defHeight) - (radius / 2));
            context.stroke();
          }
    }

    listener.subscribe(function (message) {
        readX = message.<?= $robot->topic->mes_type->x_par ?> - originX;
        readY = message.<?= $robot->topic->mes_type->y_par ?> - originY;
        readT = quad_to_euler(message.pose.pose.orientation);
        draw();
    });

    var listener2 = new ROSLIB.Topic({
        ros: ros,
        name: '/camera/rgb/image_raw/compressed',
        messageType: 'sensor_msgs/CompressedImage'
    });

    listener2.subscribe(function (message) {
        var image = document.getElementById("cameraImg");
        image.src = "data:image/jpeg;base64," + message.data;
    });

    var listener3 = new ROSLIB.Topic({
        ros: ros,
        name: "/map_metadata",
        messageType: 'nav_msgs/MapMetaData'
    });

    var goalReached = new ROSLIB.Topic({
        ros: ros,
        name: "/move_base/result",
        messageType: 'move_base_msgs/MoveBaseActionResult'
    });

    goalReached.subscribe(function(message){
        var status = message.status.status;
        console.log(status);
        if(status == 3){
          goalExists = false;
        }
    });

    listener3.subscribe(function (message) {
        defWidth = message.width;
        defHeight = message.height;
        defResolution = message.resolution;
        originX =  message.origin.position.x;
        originY =  message.origin.position.y;
        listener3.unsubscribe();
    });

    var goal = new ROSLIB.Topic({
      ros : ros,
      name : '/move_base_simple/goal',
      messageType : 'geometry_msgs/PoseStamped'
    });

    goal.subscribe(function (message) {
        goalX = ((message.pose.position.x - originX) / defResolution) * (canvas.width / defWidth);
        goalY = (defHeight - (message.pose.position.y - originY) / defResolution) * (canvas.height / defHeight);
        goalExists = true;
        draw();
    });

    function getCursorPosition(event) {
        var canvas = document.getElementById("mapCanvas");
        var rect = canvas.getBoundingClientRect();
        var positionX = event.clientX - rect.left;
        var positionY = event.clientY - rect.top;
        console.log("x: " + positionX + " y: " + positionY);

        alert("x: " + positionX + "  y: " + positionY);

        var sequence = 0;

        var poseStamped = new ROSLIB.Message({
          header : {
            seq : sequence,
            stamp : (new Date).getTime(),
            frame_id : "/odom"
          },
          pose : {
            position : new ROSLIB.Vector3({
              x: (positionX * defWidth * defResolution / canvas.width) + originX ,
              y: (-((positionY * defHeight / canvas.height) - defHeight)) * defResolution + originY,
              z: 0
            }),
            orientation : new ROSLIB.Quaternion()
          }
        });
        sequence = sequence + 1;
        console.log(poseStamped);
        goal.publish(poseStamped);
    }

    $(function () {
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
            viewer.shift(originX, originY);
        });

    });
</script>

<?php $this->end(); ?>

<h1>Iteration 3</h1>
<div>
    <span>X cord:</span>
    <span id="x_cord"></span>
    <br>
    <span>Y cord:</span>
    <span id="y_cord"></span>
    <br>
    <span>Theta:</span>
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
