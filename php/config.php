<?php

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = msqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("De connectie kon niet tot stand gebracht worden: ".mysqli_connect_error());
}