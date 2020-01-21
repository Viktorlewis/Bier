<?php
require "../php/header.php";
?>
<main>
  <div id="errors">
    <?php
        if(isset($_GET['error'])){
          if($_GET['error'] == "emptyfields"){
            echo '<p class="signuperror">Vul alle velden in</p>';
          }  
          elseif($_GET['error'] == "invalidmail"){
            echo '<p class="signuperror">email niet geldig</p>';
          }
          elseif($_GET['error'] == "invalidmailuid"){
            echo '<p class="signuperror">gelieve een mailadres en gebruikersnaam in te vullen</p>';
          }
          elseif($_GET['error'] == "invalidusername"){
            echo '<p class="signuperror">Gebruikersnaam niet geldig</p>';
          }
          elseif($_GET['error'] == "sqlerror"){
            echo '<p class="signuperror">Oeps, dit lukte niet. Probeer het later opnieuw</p>';
          }
          elseif($_GET['error'] == "usertaken"){
            echo '<p class="signuperror">Deze gebruiker bestaat al</p>';
          }
          elseif($_GET['error'] == "passwordcheck"){
            echo '<p class="signuperror">Wachtwoorden komen niet overeen</p>';
          }
          elseif($_GET['error'] == "passwordcheck"){
            echo '<p class="signuperror">Wachtwoorden komen niet overeen</p>';
          }
          elseif($_GET['error'] == "passwordcheck"){
            echo '<p class="signuperror">Wachtwoorden komen niet overeen</p>';
          }
        }
        elseif(isset($_GET['register']) == "success"){
            echo '<p class="success">Registratie geslaagd.</p>';
            header("Location: login.php");
            exit();
           
        }
    ?>
    </div>

    <!-- Register FORM -->
        <form action="../php/register-logic.php"  method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="password" name="passwordSecond"  placeholder="password sec">

            <button type="submit" name="register-submit">Registreer</button> 
        </form>
    <!-- END REGISTER -->
</main>

<?php
require "../php/footer.php";
?>