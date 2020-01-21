<?php
require "../php/header.php";
?>
<main id="profiles-page">


<?php
    if(isset($_SESSION['username'])){

    echo "<h1>Profielpagina van ".$_SESSION['username']."</h1>";
    require '../php/config.php';

        $sql = "SELECT username,email FROM Users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/profiles.php?error=sqlerror");
            if(isset($_GET["error"]) == "sqlerror"){
                echo "<p class='error'>Oeps, probeer het later eens opnieuw</p>";
            }
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $personalData = array();
            while($row = mysqli_fetch_assoc($result)){
            $personalData[] = $row;
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else{
        header("Location: login.php");
        exit();
    }
?>

<table>
<tr>
<td id="left">Gebruikersnaam: </td>
<td id="right"><?php echo $personalData[0]['username']; ?></td>
</tr>
<tr>
<td id="left">Emailadres: </td>
<td id="right"><?php echo $personalData[0]['email']; ?></td>
</tr>
</table>

<?php
if(isset($_GET['error'])){
    if($_GET['error'] == "emptyfields"){
      echo '<p class="signuperror">Vul alle velden in</p>';
    }
    elseif($_GET['error'] == "sqlerror"){
      echo '<p class="signuperror">Oeps, fout! probeer het later nogmaals</p>';
    }
  }
  elseif(isset($_GET['status'])){
    if($_GET['status'] == "successcaf"){
      echo '<p class="success">Cafereview oploaden geslaagd.</p>';
    }
    elseif($_GET['status'] == "successbier"){
      echo '<p class="success">Bierreview oploaden geslaagd.</p>';
    }
  }

    echo '<div id="bier-review"><form method="POST" action="../php/review-logic.php">
      <h1>BIER REVIEW</h1>
      <label for="biernaam">Biermerk</label>
        <input type="text" name="biernaam" placeholder="Biermerk">
          <label for="alcoholPerc">°alc</label>
        <input type="number" name="alcoholPerc" placeholder="°alc" step=0.1>

        <!-- SLIDER SCORE -->
        <label for="score">Score</label>
        <input type="range" name="score" min="0" max="100" value="0">
        <label for="score">Prijs</label>
        <input type="number" name="prijs" placeholder="prijs" step=0.1 min=0>
          <label for="reviewtekst">Schrijf hier uw review.</label>
        <textarea name="reviewtekst" max=600 placeholder="Type uw review"></textarea>

        <button type="submit" name="bier-review-submit">Opslaan</button>



    </form></div>
    <div id="cafe-review">
    <form method="POST" action="../php/review-logic.php">
    <h1>CAFE REVIEW</h1>
    <label for="cafenaam">Cafenaam</label>
    <input type="text" name="cafenaam" placeholder="Cafe naam">
    <label for="cafelocatie">Cafe locatie</label>
    <input type="text" name="cafelocatie" placeholder="adres">

    <!-- SLIDER SCORE -->
      <label for="score">Score</label>
    <input type="range" name="score" min="0" max="100" value="0">


<label for="reviewtekst">Schrijf hier uw review.</label>
    <textarea name="reviewtekst" max=600 placeholder="Type uw review"></textarea>

    <button type="submit" name="cafe-review-submit">Opslaan</button>



  </form>
    </div>
    ';
?>




</main>




<?php
require "../php/footer.php";
?>
