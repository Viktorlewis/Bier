<?php
require "../php/header.php";
?>
<main id="reviewpage">
<?php

if(isset($_GET['error'])){
  if($_GET['error'] == "emptyfields"){
    echo '<p class="signuperror">Vul alle velden in</p>';
  }  
  elseif($_GET['error'] == "sqlerror"){
    echo '<p class="signuperror">Oeps, fout! probeer het later nogmaals</p>';
  }
}
elseif(isset($_GET['register']) == "success"){
    echo '<p class="success">Review oploaden geslaagd.</p>';
}
  echo '<form method="POST" action="../php/review-logic.php">

      <input type="text" name="biernaam" placeholder="Biermerk">
      <input type="number" name="alcoholPerc" placeholder="°alc" step=0.1>

      <!-- SLIDER SCORE --> 
      <input type="range" name="score" min="0" max="100" value="0">

      <input type="number" name="prijs" placeholder="prijs" step=0.1 min=0>
      <textarea name="reviewtekst" max=600></textarea>

      <button type="submit" name="bier-review-submit">Opslaan</button>


  </form>';

 
?>

</main>

<?php
require "../php/footer.php";
?>