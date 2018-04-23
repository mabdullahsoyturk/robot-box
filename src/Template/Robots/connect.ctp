<?php
$this->append("css");
?>

<style>
    .map{position:absolute;z-index:1;}
    #myContainer{
        display:inline-block;
        width:600px;
        height:500px;
        margin: 0 auto;
        position:relative;
    }

    #mapCanvas{
        position:relative;
        z-index:20;
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

    ros.on('error', function(error) {
        document.getElementById('connecting').style.display = 'none';
        document.getElementById('connected').style.display = 'none';
        document.getElementById('closed').style.display = 'none';
        document.getElementById('error').style.display = 'inline';
        console.log(error);
    });

    ros.on('connection', function() {
        console.log('Connection made!');
        document.getElementById('connecting').style.display = 'none';
        document.getElementById('error').style.display = 'none';
        document.getElementById('closed').style.display = 'none';
        document.getElementById('connected').style.display = 'inline';
    });

    ros.on('close', function() {
        console.log('Connection closed.');
        document.getElementById('connecting').style.display = 'none';
        document.getElementById('connected').style.display = 'none';
        document.getElementById('closed').style.display = 'inline';
    });

    ros.connect('ws://<?= $robot->ip_address ?>:<?= $robot->port ?>');

    var listener = new ROSLIB.Topic({
        ros : ros,
        name : '<?= $robot->topic->name ?>',
        messageType : '<?= $robot->topic->mes_type->name ?>'
    });

    var listener2 = new ROSLIB.Topic({
        ros : ros,
        name : '/camera/rgb/image_raw',
        messageType : 'sensor_msgs/Image'
    });

    listener2.subscribe(function(message) {
        var uint8array = new TextEncoder("utf-8").encode(message.data);
        var b = 0;
        var g = 0;
        var r = 0;
        var canvas = document.getElementById("cameraCanvas");
        var context = canvas.getContext('2d');
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.beginPath();
        var x = 0;
        var y = 0;
        for(var i = 0; i < uint8array.length; i++) {
            if (i % 3 == 0) {
                b = uint8array[i];
            } else if (i % 3 == 1) {
                g = uint8array[i];
            } else if (i % 3 == 2) {
                r = uint8array[i];
                context.fillStyle = "rgb(" + r + "," + g + "," + b + ")";
                context.fillRect(x, y, 1, 1);
                x = x + 1;
                if (x == 640) {
                    x = 0;
                    y++;
                }
            }
        }
        context.stroke();
    });


    listener.subscribe(function(message) {
        var canvas = document.getElementById("mapCanvas");
        var context = canvas.getContext('2d');
        var centerX = message.x * (canvas.width / 11.088889122009277);
        var centerY = (11.088889122009277 - message.y) * (canvas.height / 11.088889122009277);
        var radius = 7;

        $("#x_cord").text(message.x);
        $("#y_cord").text(message.y);
        $("#theta").text(message.theta);

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
        context.lineTo(centerX - radius * Math.sin(message.theta - Math.PI / 2), centerY - radius * Math.cos(message.theta - Math.PI / 2));
        context.stroke();


    });

    $(function() {
        var viewer = new ROS2D.Viewer({
            divID : 'map',
            width : 600,
            height : 500
        });

        var gridClient = new ROS2D.OccupancyGridClient({
            ros : ros,
            rootObject : viewer.scene
        });

        gridClient.on('change', function(){
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
    <canvas id="cameraCanvas" width="640" height="480"></canvas>
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