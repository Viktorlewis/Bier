<?php
require "../php/header.php";
?>

<main>
    <?php
        if(isset($_GET['error'])){
          if($_GET['error'] == "emptyfields"){
            echo '<p class="signuperror">Vul alle velden in</p>';
          }  
          elseif($_GET['error'] == "sqlerror"){
            echo '<p class="signuperror">Oeps, probeer het later nogmaals</p>';
          }
          elseif($_GET['error'] == "wrongpassword"){
            echo '<p class="signuperror">Wachtwoord/gebruikersnaam verkeerd</p>';
          }
          elseif($_GET['error'] == "nouser"){
            echo '<p class="signuperror">Deze gebruiker bestaat niet</p>';
          }
        }
        elseif(isset($_GET['login']) == "success"){
            echo '<p class="success">Welkom!</p>';
            header("Location: ../index.php");
            exit();
        }
    ?>
    <p><a href="register.php">Nog geen login-gegevens?</a></p>

    <!-- LOGIN FORM -->
        <form action="../php/login-logic.php" method="POST">
            <input type="text" name="mailorusername" placeholer="E-mail">
            <input type="password" name="password-login" placeholder="Wachtwoord">
            <button type="submit" name="login-submit">Log in</button>
        </form>
    <!-- END LOGIN -->
</main>

<?php
require "../php/footer.php";
?>