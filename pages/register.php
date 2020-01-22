<?php
require "../php/header.php";
?>

<?php
  if(isset($_SESSION['username'])){
    header("Location: ../index.php");
  }
?>

<main id="register-page">
  <div class="errors">
    <?php
        if(isset($_GET['error'])){
          if($_GET['error'] == "emptyfields"){
            echo '<p class="center-info error">Vul alle velden in</p>';
          }  
          elseif($_GET['error'] == "invalidmail"){
            echo '<p class="center-info error">email niet geldig</p>';
          }
          elseif($_GET['error'] == "invalidmailuid"){
            echo '<p class="center-info error">gelieve een mailadres en gebruikersnaam in te vullen</p>';
          }
          elseif($_GET['error'] == "invalidusername"){
            echo '<p class="center-info error">Gebruikersnaam niet geldig</p>';
          }
          elseif($_GET['error'] == "sqlerror"){
            echo '<p class="center-info error">Oeps, dit lukte niet. Probeer het later opnieuw</p>';
          }
          elseif($_GET['error'] == "usertaken"){
            echo '<p class="center-info error">Deze gebruiker bestaat al</p>';
          }
        }
        elseif(isset($_GET['register']) == "success"){
            echo '<p class="center-info success">Registratie geslaagd.</p>'; 
        }
    ?>
    </div>

    <!-- Register FORM -->
        <form action="../php/register-logic.php"  method="POST">
        <fieldset>
            <label for="username">Gebruikersnaam: </label>
            <input type="text" name="username" placeholder="Username">
            </fieldset>
            <fieldset>
            <label for="email">Emailadres:  </label>
            <input type="email" name="email" placeholder="email">
            </fieldset>
            <fieldset>
            <label for="password">Wachtwoord: </label>
            <input type="password" name="password" placeholder="password">
            </fieldset>
            <label for="passwordSecond">Herhaal wachtwoord: </label>
            <input type="password" name="passwordSecond"  placeholder="password sec">
            <p class="formlink"><a href="login.php">Al login gegevens?</a></p>
            </fieldset>
            <br>
            <button type="submit" class="headerbutton" name="register-submit">Registreer</button> 
        </form>
    <!-- END REGISTER -->
</main>

<?php
require "../php/footer.php";
?>