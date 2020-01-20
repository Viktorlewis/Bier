<?php
require "../php/header.php";
?>
<main id="profiles-page">

<?php 
    echo "<h1>Profielpagina van ".$_SESSION['username']."</h1>";
    require '../php/config.php';

    if(isset($_SESSION['username'])){
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


</main>




<?php
require "../php/footer.php";
?>