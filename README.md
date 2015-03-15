ZendSkeletonApplication
=======================

Introduction
------------
This is a simple blood pressure log application based on Zend Framework 2 Skeleton App.

Installation
------------

### Create the Database ###
```
CREATE TABLE `bloodpressurelog` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   `systolic` int(11) NOT NULL DEFAULT '0',
   `diastolic` int(11) NOT NULL DEFAULT '0',
   `bpm` int(11) NOT NULL DEFAULT '0',
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
```

### Set the configuration ###
Edit the /config/autoload/local.php to include
```
return [
    'db' => [
        'username' => 'username',
        'dsn' => 'mysql:dbname=databaseName;host=localhost',
        'password' => 'password',
    ],
];
```

and you should be good to go.