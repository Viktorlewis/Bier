<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("De connectie kon niet tot stand gebracht worden: ".mysqli_connect_error());
}
