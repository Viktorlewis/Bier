<?php
if(isset($_POST['register-submit'])){
    require 'config.php';

    $username = $_POST[''];
    $email = $_POST[''];
    $password = $_POST[''];
    $password_repeat = $_POST[''];

    if(empty($username) || empty($email) || empty($password) || empty($password_repeat)){
        header("Location: ../html/register.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../html/register.php?error=invalidmailuid");
        exit();
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../html/register.php?error=invalidmail&uid=".$username);
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../html/register.php?error=invalidusername&mail=".$email);
        exit();
    }
    elseif($password !== $password_repeat){
        header("Location: ../html/register.php?error=passwordcheck&username=".$username."mail=".$email);
        exit();
    }
    else{
       $sql = "SELECT uid FROM users where uid=?";
       $stmt =  mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../html/register.php?error=sqlerror");
            exit();
       }
       else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_num_rows($stmt);
            if($result > 0){
                header("Location: ../html/register.php?error=usertaken&mail=".$mail);
                exit();
            } else{
                $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
                $stmt =  mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../html/register.php?error=sqlerror");
                    exit();
               } else{
                $hashpw = $password_hash($password, PASSWORD_DEFAULT);   
                mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashpw);
                mysqli_stmt_execute($stmt);
                header("Location: ../html/register.php?register=success");
                exit();
               }
            }
       }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../html/register.php");
    exit();
}