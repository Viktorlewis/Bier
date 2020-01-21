<?php
require "../php/header.php";
?>
<main id="reviewpage">
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
  echo '<div class="beer">
            <img class="beer-img" style="width: 10%; height: 10%" alt="'.$row['biernaam'].'" src="../img/bieren/'.$row['biernaam'].'.png" />
            <h3>Bierreview '.$row['biernaam'].'<strong>('.$row['AlcoholPerc'].')</strong></h3>
            <p class="reviewtekst">'.$row['reviewtekst'].'</p>
            <ul class="cijfers">
            <li>Gemiddelde prijs - €'.$row['PrijsGem'].'</li>
            <li>Algemene score - '.$row['Score'].' /100</li>
            <li>Aantal review - '.$row['AantalReviews'].'</li>
            </ul>
        </div>';
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
  echo '<div class="cafe">
            <img class="cafe-img" style="width: 20%; height: 20%" alt="'.$row['naam'].'" src="../img/cafes/temp-caf.jpg" />
            <h3>Cafereview '.$row['naam'].'</h3>
            <p class="adres">'.$row['Locatie'].'</p>
            <p>'.$row['reviewtekst'].'</p>
            <ul class="cijfers">
            <li>Wifi? - '.$row['wifi'].'</li>
            <li>Sanitair? - '.$row['sanitair'].'</li>
            <li>Algemene score - '.$row['Score'].' /100</li>
            <li>Aantal revieuws - '.$row['AantalReviews'].'</li>
            </ul>
        </div>';
}
?>
</div>
</main>

<?php
require "../php/footer.php";
?>