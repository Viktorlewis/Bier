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
        <input type="text" name="biernaam" placeholder="Biermerk">
        <input type="number" name="alcoholPerc" placeholder="°alc" step=0.1>
  
        <!-- SLIDER SCORE --> 
        <input type="range" name="score" min="0" max="100" value="0">
  
        <input type="number" name="prijs" placeholder="prijs" step=0.1 min=0>
        <textarea name="reviewtekst" max=600></textarea>
  
        <button type="submit" name="bier-review-submit">Opslaan</button>
      
  
  
    </form></div>
    <div id="cafe-review">
    <form method="POST" action="../php/review-logic.php">
    <h1>CAFE REVIEW</h1>
    <input type="text" name="cafenaam" placeholder="Cafe naam">
    <input type="text" name="cafelocatie" placeholder="adres"> 
  
    <!-- SLIDER SCORE --> 
    <input type="range" name="score" min="0" max="100" value="0">
  
  
  
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