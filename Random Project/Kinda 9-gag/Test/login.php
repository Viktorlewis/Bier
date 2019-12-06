<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-grid.css" rel="stylesheet">
    <link href="assets/css/bootstrap-reboot.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/screen.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
function setResponse(response) { 
    document.getElementById('captcha-response').value = response; 
}
</script>
</head>
<body class="container col-3 box-shadow mx-auto" style="border-radius: 20px">
<main class="container text-center ">
    <section id="loginSection">
        <header class="popover-header">
            <h1 class="display-2 text-center">Login</h1>
        </header>

        <form class="form-signin" method="post" enctype="multipart/form-data" action="">
  	<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <label for="loginUsername" class="sr-only">Username</label>
            <input type="text" id="loginUsername" name="loginUsername" class="form-control"
                   placeholder="Enter your username"
                   style="margin-bottom: 2px" required autofocus>

            <label for="loginPassword" class="sr-only">Password</label>
            <input type="password" id="loginPassword" name="loginPassword" class="form-control" placeholder="Password"
                   required>
		
            <button class="g-recaptcha btn btn-lg btn-primary btn-block" data-sitekey="6LevKnsUAAAAAOFSnk6BQs3nFS6DOGi9N6zaZ43p" data-callback="setResponse" type="submit" name="login" id="login">Sign in</button> 
	<input type="hidden" id="captcha-response" name="captcha-response" />          
<a href="#" class="btn-link" id="registerLink">Not a member yeet?</a>
        </form>
    </section>

    <section id="registerSection" class="hidden">
        <header class="popover-header">
            <h1 class="display-2 text-center">Register</h1>
        </header>

        <form class="form-signin" method="post" enctype="multipart/form-data" action="">
            <h1 class="h3 mb-3 font-weight-normal">Please register</h1>

            <label for="registerUsername" class="sr-only">Username</label>
            <input type="text" id="registerUsername" name="registerUsername" class="form-control"
                   placeholder="Enter your username" required
                   autofocus>

            <label for="registerEmail" class="sr-only">Email address</label>
            <input type="email" id="registerEmail" name="registerEmail" class="form-control"
                   placeholder="Enter your email address" required
                   autofocus>

            <label for="registerPassword" class="sr-only">Password</label>
            <input type="password" id="registerPassword" name="registerPassword" class="form-control"
                   placeholder="Password" required>

            <label for="registerPasswordRepeat" class="sr-only">Password</label>
            <input type="password" id="registerPasswordRepeat" name="registerPasswordRepeat" class="form-control"
                   placeholder="Retype your Password"
                   required>
	  <div class="g-recaptcha" data-sitekey="6LevKnsUAAAAAOFSnk6BQs3nFS6DOGi9N6zaZ43p"></div>    
    	<input type="hidden" id="captcha-response" name="captcha-response" />
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="register" id="register">Register
            </button>

            <a href="#" class="btn-link" id="loginLink">Sign in</a>
        </form>
    </section>

</main>

<?php
include_once 'assets/php/Db.php';
session_start();

$_SESSION['login'] = null;
if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, 'loginUsername', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'loginPassword', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!isset($_SESSION['redirect'])) {
        $_SESSION['redirect'] = "/Test/index.php";
    }
    $url = $_SESSION['redirect'];

    $db = Db::getdbInstantie();
    $db->login($username, $password, $url);
}

if (isset($_POST['register'])) {
    $username = filter_input(INPUT_POST, 'registerUsername', FILTER_SANITIZE_SPECIAL_CHARS);

    $password = filter_input(INPUT_POST, 'registerPassword', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'registerEmail', FILTER_SANITIZE_SPECIAL_CHARS);

    if (validation()) {
        $db = Db::getdbInstantie();
        $db->register($username, $password, $email);
    }
}

function validation()
{
    return checkIfUserExists() && checkEmailLinkedToUser() && checkPasswords();
}

function checkIfUserExists()
{
    $valid = false;
    $username = filter_input(INPUT_POST, 'registerUsername', FILTER_SANITIZE_SPECIAL_CHARS);

    $db = Db::getdbInstantie();
    $user = $db->getUserWithParameter("username", $username);

    if (!isset($user)) {
        $valid = true;
    } else {
        echo "<p class='alert alert-danger alert-dismissible'>Username already exists.</p>";
    }

    return $valid;
}

function checkEmailLinkedToUser()
{
    $valid = false;
    $email = filter_input(INPUT_POST, 'registerEmail', FILTER_SANITIZE_SPECIAL_CHARS);

    $db = Db::getdbInstantie();
    $user = $db->getUserWithParameter("email", $email);

    if (!isset($user)) {
        $valid = true;
    } else {
        echo "<p class='alert alert-danger alert-dismissible'>Email is already in use.</p>";
    }

    return $valid;
}

function checkPasswords()
{
    $valid = false;
    $password = filter_input(INPUT_POST, 'registerPassword', FILTER_SANITIZE_SPECIAL_CHARS);
    $passwordRepeat = filter_input(INPUT_POST, 'registerPasswordRepeat', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($password === $passwordRepeat) {
        $valid = true;
    } else {
        echo "<p class='alert alert-danger alert-dismissible'>Passwords are not equal.</p>";
    }

    return $valid;
}

?>

<script src="assets/js/script.js"></script>

</body>
</html>
