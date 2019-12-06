<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-grid.css" rel="stylesheet">
    <link href="assets/css/bootstrap-reboot.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/screen.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Welcome to your page, Memelord!</title>
</head>

<body>
<?php session_start(); ?>
<div class="container rounded">
    <div class='jumbotron'>
        <h1 class='display-4'>Admin page</h1>
        <button class="btn btn-primary float-right" onclick="window.location.href='index.php'">Go to index page</button>
    </div>

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

    showUsers();

    function showUsers()
    {
        $db = Db::getdbInstantie();
        $users = $db->getUsers();

        echo "<div id='users' class='mr-5'>";
        echo "<h2 class='mb-3'>User management</h2>";
        echo "<table class='table mb-4'><tr><th>Username</th><th>Show user memes</th><th>Delete user</th></tr>";

        foreach ($users as $user) {
            $memes = $db->getMemesOfUser($user->userID);

            echo "<tr><td>@$user->username</td>";

            if ($memes) {
                echo "<td class='pt-4'><form method='POST' enctype='multipart/form-data' class='form-group container'>";
                echo "<button type='submit' name='showMemes' value='$user->username' class='btn btn-primary'>Show memes</button></form></td>";

            } else {
                echo "<td></td>";
            }

            if ($user->position == 'user') {
                echo "<td class='pt-4'><form method='POST' enctype='multipart/form-data' class='form-group container'>";
                echo "<button type='submit' name='deleteUser' value='$user->username' class='btn btn-dark'>Delete user</button></form></td>";
            } else {
                echo "<td></td>";
            }

        }

        echo "</table>";
        echo "</div>";
    }



    if (isset($_POST['deleteUser'])) {
        $username = filter_input(INPUT_POST, 'deleteUser', FILTER_SANITIZE_SPECIAL_CHARS);

        $db = Db::getdbInstantie();
        $db->deleteUser($username);

        header("Refresh:0");
    }


    // ISSUES
    $issues = $db->getIssues(0);
    $solvedIssies = $db->getIssues(1);

    showIssues($issues, false);

    function showIssues($issues, $isSolved)
    {
        $db = Db::getdbInstantie();

        if ($isSolved === false) {
            echo "<h2 class='mb-3'>Issue list</h2>";
        }

        echo "<div id='issues' class=''>";
        echo "<ul class='mb-4'>";

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
        echo "</div>";
    }

    if (isset($_POST['deleteMeme'])) {
        $memeID = filter_input(INPUT_POST, 'deleteMeme', FILTER_SANITIZE_SPECIAL_CHARS);
        $db = Db::getdbInstantie();
        $db->deleteMeme($memeID);
    }

    if (isset($_POST['solved'])) {
        $db->issueSolved($_POST['solved']);
        header("Refresh:0");
    }

    if (isset($_POST['showMemes'])) {
        $username = filter_input(INPUT_POST, 'showMemes', FILTER_SANITIZE_SPECIAL_CHARS);

        $db = Db::getdbInstantie();
        $user = $db->getUserWithParameter("username", $username);
        $memes = $db->getMemesOfUser($user->userID);

        if ($memes != null) {
            echo "<div id='memes' class='d-block float-left'>";
            echo "<h2 class=''>Memes of @$user->username</h2>";
            echo "<ul class='list-group ml-2 mb-4 d-block float-none'>";

            foreach ($memes as $meme) {
                $db = Db::getdbInstantie();
                $username = $db->getUserWithParameter("userID", $meme->userID)->username;
                $src = $meme->directory . $meme->name;
                $comments = $db->getComments($meme->memeID);

                echo "<li class='list-group-item meme'>";
                echo "<div class='memeBlock'>";
                echo "<p class='mb-0'><strong>@$username</strong></p>";
                echo "<p><em>$meme->title</em></p>";
                echo "<img src='$src' alt='$username' />";
                echo "</div>";
                echo "<div class='commentBlock ml-3'>";
                echo "<ul class='comments'>";

                foreach ($comments as $comment) {
                    echo "<li class='list-unstyled p-2'>";
                    echo "<strong>@$username</strong> - <em>$comment->comment</em>";
                    echo "</li>";
                }

                echo "<form method='POST' enctype='multipart/form-data' class='form-group container'>";
                echo "<button type='submit' name='deleteMeme' value='$meme->memeID' class='btn btn-dark float-right mt-5'>Delete meme :(</button></form>";

                echo "</ul></div></li>";
            }

            echo "</ul>";
            echo "<div>";
        }

    }
    ?>
</div>
</body>
</html>
