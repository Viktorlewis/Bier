<?php
//BRON - Jonathan - Opdrachten - Howest
if(isset($_POST['login-submit'])){
    require 'config.php';

    $mailuid = $_POST['mailorusername'];
    $password = $_POST['password'];

    if(empty($mailuid) || empty($password)){
        header("Location: ../html/index.php?error=emptyfields");
        exit();    
    }
    else{
        $sql = "SELECT * FROM Users WHERE username=? OR email=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $passwordCheck = password_verify($password, $row['password']);
                if($passwordCheck == false){
                    header("Location: ../html/login.php?error=wrongpassword");
                    exit();
                } elseif($passwordCheck == true){
                    session_start();
                    $_SESSION['userId'] = $row[id];
                    $_SESSION['username'] = $row[username];
                    header("Location: ../html/login.php?login=success");
                    exit();
                } else {
                    header("Location: ../html/login.php?error=wrongpassword");
                    exit();
                }
            }
            else {
                header("Location: ../html/login.php?error=nouser");
                exit();
            }
        }
    }
} else{
    header("Location: ../html/login.php");
    exit();
}