<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bierpunt</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/headerAndFooter.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="shortcut icon" type="image/x-icon" href="../img/bierlogo.png"/>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1 class="mh-logo">
                <img src="../img/bierpunt-logo.jpg" alt="logo">
            </h1>
            <nav class="main-nav">
                <ul class="main-nav-list">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../pages/ranking.php">Rankings</a></li>
                    <li><a href="../pages/reviews.php">Reviews</a></li>
                    <li><a href="../pages/profiles.php">Profile</a></li>
                    <li><a href="../pages/contact.php">Contact</a></li>
                </ul>
            </nav>
            <ul class="socials">
            <?php
            if(isset($_SESSION['username'])){
                echo '<li>Welkom <a href="/pages/profiles.php">'.$_SESSION['username'].'</a></li>
                <li><a  class="headerbutton" href="/php/logout.php">Log uit</a></li>';
            } else{
                echo '<li><a class="headerbutton" href="/pages/login.php">Login</a></li>
                <li><a class="headerbutton" href="/pages/register.php">Registreer</a></li>';
            }
                
            ?>
            </ul>
         
        </div>
      </header>
