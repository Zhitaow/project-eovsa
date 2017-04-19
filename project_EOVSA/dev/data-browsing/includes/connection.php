<?php

define('DB_USER','username');
define('DB_PASSWORD','password');
define('DB_HOST','localhost');
define('DB_NAME','datebase');

// Make the conncetion and then select the database.
$conn = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Could not connect to MySQL: ' . mysql_error());
@mysql_select_db(DB_NAME) or die('Could not select the database:' . mysql_error());

// check connection
if( !$conn ) {
    die( "Connection failed: " . mysql_connect_error() );
    echo "Connection failed";
}
?>