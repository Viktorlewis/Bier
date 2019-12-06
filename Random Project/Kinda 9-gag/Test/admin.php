<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-grid.css" rel="stylesheet">
    <link href="assets/css/bootstrap-reboot.css" rel="stylesheet">
    <!--    <link rel="stylesheet" href="assets/css/screen.css">-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>admin</title>
</head>

<body>
<?php session_start(); ?>

<p>Deze pagina zou enkel zichtbaar mogen zijn voor admin users!</p>
<a href="index.php">Go to index page</a>

<?php
include_once 'assets/php/Db.php';

$db = Db::getdbInstantie();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
} else {
    $username = $_SESSION['login']->username;
    $user = $db->getUserWithParameter("username", $username);

    if ($user->position !== "admin") {
        header('Location: try.php');
    }
}

// Session expires after 30 minutes
if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > 1800)) {
    session_destroy();
    session_unset();
}

$_SESSION['LAST_ACTIVITY'] = time();


$issues = $db->getIssues(0);
$solvedIssies = $db->getIssues(1);

showIssues($issues, false);
showIssues($solvedIssies, true);


function showIssues($issues, $isSolved)
{
    $db = Db::getdbInstantie();

    if ($isSolved === false) {
        echo "<h1 class='mt-5'>Issue list</h1>";
    } else {
        echo "<h1 class='mt-5'>Solved issues list</h1>";
    }

    echo "<ul>";

    foreach ($issues as $issue) {
        $username = $db->getUserWithParameter("userID", $issue->userID)->username;

        echo "<li class='list-unstyled'>";

        echo "<p class='mb-0'><strong>@$username</strong></p>";
        echo "<p><em>$issue->title</em></p>";
        echo "<p><small>$issue->issue</small></p>";

        if ($isSolved === false) {
            echo "<form method='post'><button type='submit' name='solved' value='" . $issue->issueID . "'>Issue solved</button></form>";
        }

        echo "</li>";
    }

    echo "</ul>";
}


if (isset($_POST['solved'])) {
    $db->issueSolved($_POST['solved']);
    header("Refresh:0");
}

?>

</body>
</html>
