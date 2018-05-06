# UI For Warehouse Robot


UI For Warehouse Robot is a ROS project that can be used to display the map of the environment, which Turtlebot placed, and the compressed camera view of the robot in any browser. Also, you can give a goal to the robot through map in the browser.


## Requirements

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

	Import the SQL, which is in the ros_database.sql, into the your database.

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
