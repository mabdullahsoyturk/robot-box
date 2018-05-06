	# ui-for-warehouse-robot


	UI-for-Warehouse-Robot is a ROS project that can be used to display the map of the environment, which Turtlebot placed, and the compressed camera view of the robot in any browser. Also, you can give a goal to the robot through map in the browser.


	## Requirements

	### LAMP

	In order to setup the project to your local, LAMP must be installed in your computer. To do that you can follow DigitalOcean's LAMP Tutorial:

	[How To Install Linux, Apache, MySQL, PHP (LAMP) stack on Ubuntu 16.04](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)

	### PHP Extensions

	Following extension should be installed in computer.

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


	### CakePHP

	CakePHP is simple and easy to install. The minimum requirements are a web server and a copy of CakePHP, that’s it! 

	You can follow the [CakePHP installation tutorial](https://book.cakephp.org/3.0/en/installation.html).



