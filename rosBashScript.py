#!/usr/bin/python

import os
import time

os.system("gnome-terminal -x roscore")
time.sleep(5)
os.system("gnome-terminal -x rosrun turtlesim turtlesim_node")
time.sleep(4)
os.system("gnome-terminal -x rosrun turtlesim turtle_teleop_key")
time.sleep(3)
os.system("gnome-terminal -x rosrun rosrun map_server map_server map/mymap.yaml")
time.sleep(3)
os.system("gnome-terminal -x roslaunch rosbridge_server rosbridge_websocket.launch")