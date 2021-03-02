<?php

	//Defining Constants
	define('HOST','localhost');
	define('USER','root');
	define('PASS','Goolean@123#');
	define('DB','restaurant_db');

	//Connecting to Database
    $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Reach our Servers!');
    mysqli_set_charset($con, 'utf8');
