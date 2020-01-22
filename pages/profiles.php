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
<td>Gebruikersnaam: </td>
<td><?php echo $personalData[0]['username']; ?></td>
</tr>
<tr>
<td>Emailadres: </td>
<td><?php echo $personalData[0]['email']; ?></td>
</tr>
</table>

<?php 
if(isset($_GET['error'])){
    if($_GET['error'] == "emptyfields"){
      echo '<p class="center-info error">Vul alle velden in</p>';
    }  
    elseif($_GET['error'] == "sqlerror"){
      echo '<p class="center-info error">Oeps, fout! probeer het later nogmaals</p>';
    }
  }
  elseif(isset($_GET['status'])){
    if($_GET['status'] == "successcaf"){
      echo '<p class="center-info success">Cafereview oploaden geslaagd.</p>';
    }
    elseif($_GET['status'] == "successbier"){
      echo '<p class="center-info sucess">Bierreview oploaden geslaagd.</p>';
    }
  }
  
    echo '<div id="bier-review">
    <h1 id="bier-header">BIER REVIEW  <strong id="bier-header-status">GESLOTEN</strong></h1>
    <form method="POST" id="bier-review-form" class="hidden" action="../php/review-logic.php">
      
        <label for="biernaam">Merk van het bier</label>
        <input type="text" name="biernaam" placeholder="Biermerk">

        <label for="alcoholPerc">Alcoholpercentage van het bier</label>
        <input type="number" name="alcoholPerc" placeholder="°alc" step=0.1>

        <label for="score-b">Geef een score op 100 <strong id="score-b-js"></strong></label>
        <input type="range" name="score-b" id="score-b" min="0" max="100" value="0">

        <label for="prijs">Wat heeft u betaald?</label>
        <input type="number" name="prijs" placeholder="prijs" step=0.1 min=0>

        <label for="reviewtekst">Argumenteer uw ervaring</label>
        <textarea name="reviewtekst" max=600></textarea>
  
        <button type="submit" name="bier-review-submit">Opslaan</button>
      
  
  
    </form></div>
    <div id="cafe-review">
    <h1 id="cafe-header">CAFE REVIEW  <strong id="cafe-header-status">GESLOTEN</strong></h1>
    <form method="POST" id="cafe-review-form" class="hidden" action="../php/review-logic.php">
    

    <label for="cafenaam">Wat is de naam van het café?</label>
    <input type="text" name="cafenaam" placeholder="Cafe naam">

    <label for="cafelocatie">Waar bevind het café zich?</label>
    <input type="text" name="cafelocatie" placeholder="adres"> 
    
    <label for="score-c">Geef een score op 100 <strong id="score-c-js"></strong></label>
    <input type="range" name="score-c" id="score-c" min="0" max="100" value="0">
    
    <label for="reviewtekst">Argumenteer uw ervaring</label>
    <textarea name="reviewtekst" max=600></textarea>
  
    <button type="submit" name="cafe-review-submit">Opslaan</button>
  
  
  
  </form>
    </div>
    ';
?>

</main>




<?php
require "../php/footer.php";
?>