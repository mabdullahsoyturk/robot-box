<?php
$this->layout = null;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />

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

  ros.connect('ws://167.99.201.200:9090');

  var listener = new ROSLIB.Topic({
    ros : ros,
    name : '/turtle1/pose',
    messageType : 'turtlesim/Pose'
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

  <style>
    .map{position:absolute;z-index:1;}

    #container{
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
</head>

<body>
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
  <div id="container">
    <div id="map" class="map"></div>
    <canvas id="mapCanvas" width="600" height="500"></canvas>
  </div>
  <p>Run the following commands in the terminal then refresh this page.</p>
  <li>
    <li>source catkin_ws/devel/setup.bash</li>
    <li>roscore</li>
    <li>rosrun turtlesim turtlesim_node</li>
    <li>rosrun turtlesim turtle_teleop_key</li>
    <li>rosrun map_server map_server map/mymap.yaml</li>
    <li>roslaunch rosbridge_server rosbridge_websocket.launch</li>
  </ol>
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
</body>
</html>
