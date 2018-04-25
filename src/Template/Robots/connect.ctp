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
        width: 600px;
        height: 500px;
        margin: 0 auto;
        position: relative;
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


    function quad_to_euler(w,z){
        var t3 = 2 * w * z;
        var t4 = 1 - (2 * z * z);
        return Math.atan2(t3, t4);
    }

    listener.subscribe(function (message) {
        var readX = message.<?= $robot->topic->mes_type->x_par ?> + 15.4;
        var readY = message.<?= $robot->topic->mes_type->y_par ?> + 13.8;
        var readT = quad_to_euler(message.pose.pose.orientation.w, message.pose.pose.orientation.z);


        console.log("H:"+defHeight + " " + "W:" + defWidth + " X:" + readX + " " + "Y:" + readY);

        var canvas = document.getElementById("mapCanvas");
        var context = canvas.getContext('2d');
        var centerX = (readX / defResolution) * (canvas.width / defWidth);
        var centerY = (defHeight - readY / defResolution) * (canvas.height / defHeight);

        var radius = 7;

        $("#x_cord").text(readX);
        $("#y_cord").text(readY);
        $("#theta").text(readT);

        context.clearRect(0, 0, canvas.width, canvas.height);
        context.beginPath();
        context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
        context.fillStyle = 'green';
        context.fill();
        context.lineWidth = 2;
        context.strokeStyle = '#003300';
        context.stroke();

        context.beginPath();
        context.moveTo(centerX, centerY);
        context.lineTo(centerX - radius * Math.sin(readT - Math.PI / 2), centerY - radius * Math.cos(readT - Math.PI / 2));
        context.stroke();
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

    listener3.subscribe(function (message) {
        defWidth = message.width;
        defHeight = message.height;
        defResolution = message.resolution;
    });


    $(function () {
        var viewer = new ROS2D.Viewer({
            divID: 'map',
            width: 600,
            height: 500
        });

        var gridClient = new ROS2D.OccupancyGridClient({
            ros: ros,
            rootObject: viewer.scene
        });

        gridClient.on('change', function () {
            viewer.scaleToDimensions(gridClient.currentGrid.width, gridClient.currentGrid.height);
        });

    });


</script>

<?php $this->end(); ?>

<h1>Simple roslib Example</h1>
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
    <canvas id="mapCanvas" width="600" height="500"></canvas>
</div>

<div>
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