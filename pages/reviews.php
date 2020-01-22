<?php
require "../php/header.php";
?>
<main id="review-page">
<div id="bier">
<h1>BIER REVIEWS</h1>
<?php
if(isset($_SESSION['username'])){
    
require '../php/config.php';

    $sql = "SELECT biernaam,AlcoholPerc,Score,PrijsGem,reviewtekst,AantalReviews FROM bieren";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../html/reviews.php?error=sqlerror");
        if(isset($_GET["error"]) == "sqlerror"){
            echo "<p class='error'>Oeps, probeer het later eens opnieuw</p>";
        }
        
        exit();
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $allBeers = array();
        while($row = mysqli_fetch_assoc($result)){
        $allBeers[] = $row;
        fillCardsBeer($row);  
        }
         
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else{
    header("Location: login.php");
    exit();
}

function fillCardsBeer($row) {
  echo '<article class="beer col">
            <img class="beer-img" alt="'.$row['biernaam'].'" src="../img/bieren/'.$row['biernaam'].'.png" />
            <h3 class="review-title">Bierreview '.$row['biernaam'].'<strong>('.$row['AlcoholPerc'].'°)</strong></h3>
            <aside><p class="reviewtekst">'.$row['reviewtekst'].'</p>
            <ul class="cijfers">
            <li><strong>Gemiddelde prijs - €'.$row['PrijsGem'].' </strong></li>
            <li><strong>Algemene score - '.$row['Score'].' /100</strong></li>
            <li><strong>Aantal review - '.$row['AantalReviews'].'</strong></li>
            </ul></aside>
        </article>';
}
?>
</div>
<div id="cafe">
<h1>CAFE REVIEWS</h1>
<?php
if(isset($_SESSION['username'])){
  require '../php/config.php';
  $sql = "SELECT naam,Locatie,reviewtekst,wifi,sanitair,Score,AantalReviews FROM cafes";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../html/reviews.php?error=sqlerror");
      if(isset($_GET["error"]) == "sqlerror"){
          echo "<p class='error'>Oeps, probeer het later eens opnieuw</p>";
      }
      
      exit();
  } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $allCafe = array();
      while($row = mysqli_fetch_assoc($result)){
      $allCafe[] = $row;
      fillCardsCafe($row);  
      }
       
  }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
  header("Location: login.php");
  exit();
}

function fillCardsCafe($row) {
  echo '<article class="cafe col">
            <img class="cafe-img" alt="'.$row['naam'].'" src="../img/cafes/temp-caf.jpg" />
            <h3 class="review-title">Cafereview '.$row['naam'].'</h3>
            <p class="adres">'.$row['Locatie'].'</p>
            <aside><p>'.$row['reviewtekst'].'</p>
            <ul class="cijfers">
            <li><strong>Wifi? - '.$row['wifi'].'</strong></li>
            <li><strong>Sanitair? - '.$row['sanitair'].'</strong></li>
            <li><strong>Algemene score - '.$row['Score'].' /100</strong></li>
            <li><strong>Aantal revieuws - '.$row['AantalReviews'].'</strong></li>
            </ul></aside>
        </article>';
}
?>
</div>
</main>

<?php
require "../php/footer.php";
?>