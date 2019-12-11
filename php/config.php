<?php
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'jonathan');
define('DB_PASSWORD', 'Melanie');
define('DB_NAME', 'user');
 
/* Attempt to connect to MySQL database */
$link = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("Error: kan geen verbinding maken" . mysql_connect_error());
}
?>