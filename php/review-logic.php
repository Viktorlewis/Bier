<?php

calcTest();
if(isset($_POST['bier-review-submit'])){
    require 'config.php';

    $name = $_POST['biernaam'];
    $alcoholperc = $_POST['alcoholPerc'];
    $score = $_POST['score-b'];
    $prijs = $_POST['prijs'];
    $reviewtekst = $_POST['reviewtekst'];


    if(empty($name) || empty($alcoholperc) || empty($score) || empty($prijs) || empty($reviewtekst)){
        header("Location: ../pages/reviews.php?error=emptyfields");
        exit();
    }
    //ANDERE FILTERS ZIE REGISTER-LOGIC
    else{
        $sql = "INSERT INTO bieren(biernaam, AlcoholPerc, Score, PrijsGem, reviewtekst, AantalReviews) VALUES(?,?,?,?,?,?)";
        $stmt =  mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
             header("Location: ../pages/profiles.php?error=sqlerror");
             exit();
        }
        else {
                //KIJKEN OF AL BESTAAT EN ALTER DAN OM PRIJS EN SCORE TE WEERGEVEN
                    $reviews_dummy=rand(0,15);
                    mysqli_stmt_bind_param($stmt, "sdddsi", $name, $alcoholperc,$score,$prijs,$reviewtekst, $reviews_dummy);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $result = mysqli_stmt_num_rows($stmt);
                    header("Location: ../pages/profiles.php?status=successbier");
                 exit();
                }
             }
        
     mysqli_stmt_close($stmt);
     mysqli_close($conn);
 } 
 elseif(isset($_POST['cafe-review-submit'])){
    require 'config.php';
    $name = $_POST['cafenaam'];
    $locatie = $_POST['cafelocatie'];
    $reviewtekst = $_POST['reviewtekst'];
    
    $scorevriendelijkheid = $_POST['score-c'];
    $scoresfeer = $_POST['score-s'];
    $scorelocatie = $_POST['score-d'];
    $scoreaanbod = $_POST['score-e'];


    if(empty($name) || empty($locatie) || empty($scorevriendelijkheid) || empty($scoresfeer) || empty($scorelocatie) || empty($scoreaanbod) || empty($reviewtekst)){
        header("Location: ../pages/profiles.php?error=emptyfields");
        exit();
    } else {
        $sql = "INSERT INTO cafes(naam, Locatie, Score, reviewtekst, AantalReviews) VALUES(?,?,?,?,?)";
        $stmt =  mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
             header("Location: ../pages/profiles.php?error=sqlerror");
             exit();
        }
        else {
                //KIJKEN OF AL BESTAAT EN ALTER DAN OM PRIJS EN SCORE TE WEERGEVEN
                    $reviews_dummy=rand(0,15);
                    $scoreCal = intval(($scoreaanbod + $scorelocatie + $scoresfeer + $scorevriendelijkheid)/4);
                    mysqli_stmt_bind_param($stmt, "ssisi", $name, $locatie,$scoreCal,$reviewtekst, $reviews_dummy);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $result = mysqli_stmt_num_rows($stmt);
                    
                    header("Location: ../pages/profiles.php?status=successcaf");
                    exit();
                }
             }
        
     mysqli_stmt_close($stmt);
     mysqli_close($conn);
 }
 else {
    header("Location: ../index.php");
    exit();
}
function calcTest(){
    $test = (33+25+86+42)/4;
    echo $test;
}


function calculateScore(){
    $cal = (($scorevriendelijkheid + $scoresfeer + $scorelocatie + $scoreaanbod)/4);
    echo intval($cal);
    return intval($cal);
}




