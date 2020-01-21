<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bierpunt</title>
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/headerAndFooter.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <?php
            if(isset($_SESSION['username'])){
                echo "<p>Welkom <a href='/pages/profiles.php'>".$_SESSION['username']."</a></p>";
                echo "<p><a href='/php/logout.php'>Log uit</a></p>";
            }
                
            ?>
            
          <ul class="socials">
            <li><a href="#"><img src="../img/email.svg" alt="e-mail"></a></li>
            <li><a href="#"><img src="../img/twitter.svg" alt="twitter"></a></li>
            <li><a href="#"><img src="../img/facebook.svg" alt="facebook"></a></li>
            </ul>
        </div>
      </header>
