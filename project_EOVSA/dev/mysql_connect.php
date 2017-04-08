<?php # mysql_connect.php

// This file contains the database access information and establishes a connection to MySQL and selects the database.

// Set the database access information as constants
define('DB_USER','dbuser');
define('DB_PASSWORD','myPassword');
define('DB_HOST','localhost');
define('DB_NAME','antstatus');

// Make the conncetion and then select the database.
$dbc = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Could not connect to MySQL: ' . mysql_error());
@mysql_select_db(DB_NAME) or die('Could not select the database:' . mysql_error());
