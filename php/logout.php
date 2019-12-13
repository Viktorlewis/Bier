<?php
unset($_SESSION['login']);
$_SESSION['login'] = null;
session_destroy();
header('Location: ../../login.php');
