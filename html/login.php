<?php
require "header.php";
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
          
         
        }
        elseif(isset($_GET['login']) == "success"){
            echo '<p class="success">Welkom!</p>';
            header("Location: ../index.php");
            exit();
        }
    ?>

    <!-- LOGIN FORM -->

    <!-- END LOGIN -->
</main>

<?php
require "footer.php";
?>