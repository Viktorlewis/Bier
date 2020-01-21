<?php
require "../php/header.php";
?>

<main id="login-page">
  <div class="errors">
    <?php
        if(isset($_GET['error'])){
          if($_GET['error'] == "emptyfields"){
            echo '<p class="center-info error">Vul alle velden in</p>';
          }  
          elseif($_GET['error'] == "sqlerror"){
            echo '<p class="center-info error">Oeps, probeer het later nogmaals</p>';
          }
          elseif($_GET['error'] == "wrongpassword"){
            echo '<p class="center-info error">Wachtwoord/gebruikersnaam verkeerd</p>';
          }
          elseif($_GET['error'] == "nouser"){
            echo '<p class="center-info error">Deze gebruiker bestaat niet</p>';
          }
        }
        elseif(isset($_GET['login']) == "success"){
            echo '<p class="center-info success">Welkom!</p>';
            header("Location: ../index.php");
            exit();
        }
    ?>
    

    <!-- LOGIN FORM -->
        <form action="../php/login-logic.php" method="POST">
        <fieldset>
            <label for="mailorusername">Gebruikersnaam/ E-mail</label>
            <input type="text" name="mailorusername">
      </fieldset>
      <fieldset>
          <label for="password-login">
            <input type="password" name="password-login">
            </fieldset>  
            <button type="submit" name="login-submit">Log in</button>
        </form>
        <p><a href="register.php">Nog geen login-gegevens?</a></p>
    <!-- END LOGIN -->
</main>

<?php
require "../php/footer.php";
?>