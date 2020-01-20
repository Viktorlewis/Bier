<?php
if(isset($_POST['bier-review-submit'])){
    require 'config.php';

    $name = $_POST['biernaam'];
    $alcoholperc = $_POST['alcoholPerc'];
    $score = $_POST['score'];
    $prijs = $_POST['prijs'];
    $reviewtekst = $_POST['reviewtekst'];


    if(empty($name) || empty($alcoholperc) || empty($score) || empty($prijs) || empty($reviewtekst)){
        header("Location: ../html/reviews.php?error=emptyfields");
        exit();
    }
    //ANDERE FILTERS ZIE REGISTER-LOGIC
    else{
        $sql = "INSERT INTO bieren(biernaam, AlcoholPerc, Score, PrijsGem, reviewtekst, AantalReviews) VALUES(?,?,?,?,?,?)";
        $stmt =  mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
             header("Location: ../html/reviews.php?error=sqlerror");
             exit();
        }
        else {
                //KIJKEN OF AL BESTAAT EN ALTER DAN OM PRIJS EN SCORE TE WEERGEVEN
                $reviews_dummy=3;
                    mysqli_stmt_bind_param($stmt, "sdddsi", $name, $alcoholperc,$score,$prijs,$reviewtekst, $reviews_dummy);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $result = mysqli_stmt_num_rows($stmt);
                    header("Location: ../html/reviews.php?register=success");
                 exit();
                }
             }
        
     mysqli_stmt_close($stmt);
     mysqli_close($conn);
 } else {
    header("Location: ../index.php");
    exit();
}





