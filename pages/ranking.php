<?php
require "../php/header.php";
?>

<main id="ranking-page">
<div class="row">
    <h1>RANKINGS</h1>
</div>
 
<div class="row">
<section id="bier-ranking" class="col-sm-6">
<h2 class="title">TOP 5 Café's</h2>
<?php
if(isset($_SESSION['username'])){
  require '../php/config.php';

  $sql = "SELECT naam,Locatie,Score,AantalReviews FROM cafes ORDER BY Score DESC LIMIT 5";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../pages/ranking.php?error=sqlerror");
      exit();

  } else {

      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $allCafe = array();
      $rank = 0;
      while($row = mysqli_fetch_assoc($result)){
        $allCafe[] = $row;
        $rank += 1;
        fillCardsCafe($row, $rank);  
      }
       
  }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
  header("Location: login.php");
  exit();
}

function fillCardsCafe($row, $rank) {
  echo '<article class="cafe">
          <h1 class="rank">'.$rank.'</h1>
            <img class="cafe-img" alt="'.$row['naam'].'" src="../img/cafes/temp-caf.jpg" />
            <h3>'.$row['naam'].'</h3>
            <p class="adres">'.$row['Locatie'].'</p>
            <ul class="cijfers">
            <li>Algemene score - '.$row['Score'].' /100</li>
            <li>Aantal revieuws - '.$row['AantalReviews'].'</li>
            </ul>
        </article>';
}

?>


</section>


<section id="cafe-ranking" class="col-sm-6">
<h2 class="title">TOP 5 Bieren</h2>
<?php
if(isset($_SESSION['username'])){
  require '../php/config.php';

  $sql = "SELECT biernaam,Score,AantalReviews,AlcoholPerc FROM bieren ORDER BY Score DESC LIMIT 5";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../pages/ranking.php?error=sqlerror");
      exit();

  } else {

      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $allCafe = array();
      $rank = 0;
      while($row = mysqli_fetch_assoc($result)){
        $allCafe[] = $row;
        $rank += 1;
        fillCardsBeer($row, $rank);  
      }
       
  }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
  header("Location: login.php");
  exit();
}

function fillCardsBeer($row, $rank) {
  echo '<article class="cafe">
          <h1 class="rank">'.$rank.'</h1>
            <img class="bier-img" alt="'.$row['biernaam'].'" src="../img/bieren/'.$row['biernaam'].'.png" />
            <h3>'.$row['biernaam'].'<strong>('.$row['AlcoholPerc'].'°)</strong></h3>

            <ul class="cijfers">
            <li>Algemene score - '.$row['Score'].' /100</li>
            <li>Aantal revieuws - '.$row['AantalReviews'].'</li>
            </ul>
        </article>';

}

?>

</section>
</div>

</main>
<?php
require "../php/footer.php";
?>