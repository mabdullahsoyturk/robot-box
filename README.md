# UI For Warehouse Robot


UI For Warehouse Robot is a ROS Kinetic project that can be used to display the map of the environment, which Turtlebot placed, and the compressed camera view of the robot in any browser. Also, you can give a goal to the robot through map in the browser.


## Pre-installation

- Ubuntu 16.04
- [ROS Kinetic Kame](http://wiki.ros.org/kinetic/Installation/Ubuntu)

### LAMP

In order to setup the project to your local, LAMP must be installed in your computer. To do that you can follow DigitalOcean's LAMP Tutorial:

[How To Install Linux, Apache, MySQL, PHP (LAMP) stack on Ubuntu 16.04](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)

### PHP Extensions

Following extensions should be installed in computer.

- mbstring PHP extension

```bash
$ sudo apt-get install php7.0-mbstring
```

- intl PHP extension

```bash
$ sudo apt-get install php7.0-intl
```

- simplexml PHP extension

```bash
$ sudo apt-get install php7.0-xml
```

After installing these PHP extensions, don't forget to restart your Apache Server.

```bash
$ sudo service apache2 restart
```


## Installation

### Cloning the project

Clone the project under the "/var/www/html" folder.

```bash
$ cd /var/www/html
$ git clone https://github.com/mabdullahsoyturk/ui-for-warehouse-robot.git
```

### Initializing the Composer

To initialize the project that uses composer you need to navigate to the root folder of that project an simply execute

```bash
$ composer install
```

This command will read the dependencies from the composer.json descriptor file and downloads them ready for you to use in your project.

> If you get `vendor does not exist and could not be created.` error, your folder (var/www) probably is read-only or has not enough rights. For a quick fix, try `chmod -R 777 /var/www`, but dont use 777 in production!

### URL Rewriting 

UI For Warehouse Robot uses cakePhp framework which requires Apache mod rewrite to be enabled. You can follow CakePHP's [URL Rewriting](https://book.cakephp.org/3.0/en/installation.html#url-rewriting) tutorial.

### Connecting to Database

	Import the SQL, which is ros_database.sql in the Database folder of the repository, into the your database.

Then you move to the `config` folder in the project folder and copy the `app.default.php` and paste into the same directory, change the name of it as `app.php`.

After that, open `app.php`, and change the `'my_app'`, `'secret'` and `'my_app'` fields by your own username, password and database.

```php
...
'Datasources' => [
        'default' => [
            ...
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'my_app',
            ...	
...
```

## Tutorial

### Requirements

- Robot must has a map server
- Robot must has a camera
- Robot must publish it's position through some topic.

> This project has support only TurtleBot for now. Support for other robots will be added soon. 

### Launching [Turtlebot on Gazebo](http://wiki.ros.org/turtlebot_gazebo/Tutorials/indigo/Make%20a%20map%20and%20navigate%20with%20it#Make_a_map)

First of all, you need to launch the Gazebo in order to create a virtual environment for Turtlebot.

```bash
$ roslaunch turtlebot_gazebo turtlebot_world.launch
```

### Building the Map

In order to create map of the virtual environment, you can follow the turtlebot_gazebo [Make a map tutorial](http://wiki.ros.org/turtlebot_gazebo/Tutorials/indigo/Make%20a%20map%20and%20navigate%20with%20it#Make_a_map).

After you create your own map just run the following script.

```bash
$ roslaunch turtlebot_gazebo amcl_demo.launch map_file:=<full path to your map YAML file>
```

Or if you prefer to use an already created map, just omit the map_file argument.


### Running [Rviz](http://wiki.ros.org/rviz)

You need to launch the Rviz to be able to give goal to the robot.

```bash
$ roslaunch turtlebot_rviz_launchers view_navigation.launch
```

### Controlling the Turtlebot with [Keyboard Teleop](http://wiki.ros.org/turtlebot_teleop/Tutorials/Keyboard%20Teleop)

You can navigate the Turtlebot with pressing the `u i o j k l m , .` keys on your keyboard in the new terminal after run following script.

```bash
$ roslaunch turtlebot_teleop keyboard_teleop.launch
```

### Running [Rosbridge](http://wiki.ros.org/turtlebot_gazebo/Tutorials/indigo/Make%20a%20map%20and%20navigate%20with%20it#Make_a_map)

You need to launch the rosbrige server to create a WebSocket on port 9090 by default.

```bash
$ roslaunch rosbridge_server rosbridge_websocket.launch
```

> Now that rosbridge has been launched and a WebSocket connection is available, we can create a basic HTML webpage to send and receive calls to rosbridge. [Roslibjs](http://wiki.ros.org/roslibjs) is a JavaScript library that handles the communication for you. Check out the [getting started with roslibjs](http://wiki.ros.org/roslibjs/Tutorials/BasicRosFunctionality) tutorial to create a webpage with roslibjs and rosbridge.

### Usage

Now, everything is ready. Go to the our project in your browser. After Signup/Login, first of all, you need to create your `message type`.

For example, if you are using Turtlebot; 

```
Message name = "nav_msgs/Odometry"
X paramater = "pose.pose.position.x"
Y paramater = "pose.pose.position.y"
Theta(Angle) paramater = "pose.pose.position.z"
```

Then you need to create your `topic`.

```
Topic = "/odom"
Mes = nav_msgs/Odometry (Select message that you've created before.)
```

After that you can create your `robot`. 

```
IP address = Your IP address (If you are on localhost just "localhost".)
Port = 	9090 (Your port.)
Topic = /odom (Select topic that you've created before.)
```

After creating your robot, just tap the connect button. When you connect to the robot, you will see the map of the environment, which Turtlebot placed, positon information and the compressed camera view of the robot. Also you can give a goal to robot with clicking the destination point on the map. You can see the global path from robot the destination point. 
