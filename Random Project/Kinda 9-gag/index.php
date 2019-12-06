<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-grid.css" rel="stylesheet">
    <link href="assets/css/bootstrap-reboot.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/screen.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>schild en vriendjes*</title>
</head>

<body>
<?php session_start(); ?>
<div id="memePage" class="col-8 p-3 d-inline-block">
    <div class='jumbotron'>
        <h1 class='display-4 mb-4'>Welcome <?php echo "@" . $_SESSION['login']->username; ?></h1>


        <button class="btn btn-dark float-right" onclick="window.location.href='assets/php/logout.php'">Log out
            :(</a></button>

        <?php
        if ($_SESSION['login']->position == "admin") {
            echo "<button onclick='window.location.href=\"admin.php\"' class='btn btn-primary float-right mr-2'>Admin page</button>";
        }
        ?>

        <button id="issueOpen" class="btn btn-primary float-right mr-2">Feedback</button>
    </div>

    <button id='memeOpen' class='btn btn-lg btn-primary btn-block '>Upload a meme :)</button>

    <section id="uploadIssue" class="hidden">
        <h2 class='mt-5 container'>Issue Form</h2>
        <form method="post" enctype="multipart/form-data" class="form-group container ">
            <input type="text" id="issueSubject" name="issueSubject" placeholder="Enter the issue subject" required
                   autofocus class="form-control col-7 mb-2"/>

            <textarea name="issue" placeholder="Describe your issue here" required
                      class="form-control col-7 mb-2"></textarea>
            <button type="submit" name="submitIssue" class="btn btn-primary">Submit issue</button>
            <button type="button" name="issueClose" id="issueClose" value="issueClose" class="btn btn-dark float-right">
                close
            </button>
        </form>

    </section>

    <section id="uploadMeme" class="hidden">
        <h2 class='mt-5 container'>Meme upload</h2>

        <form method="POST" enctype="multipart/form-data" class="form-group container">
            <label>Select meme to upload:</label>
            <input type="file" name="meme" class=" col-7 mb-2" required>

            <label for="title" class="d-block">Add some text</label>
            <input type="text" id="title" name="title" class="form-control col-7 mb-2"/>
            <button type="submit" name="upload" value="upload" class="btn btn-primary">Upload meme</button>
            <button type="button" name="memeClose" id="memeClose" value="memeClose" class="btn btn-dark float-right">
                close
            </button>
        </form>


    </section>

    <?php
    include_once 'assets/php/Db.php';

    if (!isset($_SESSION['login'])) {
            $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
            header('Location: login.php');
        }

    // Session expires after 30 minutes
    if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > 1800)) {
        session_destroy();
        session_unset();
    }

    $_SESSION['LAST_ACTIVITY'] = time();

    if (isset($_POST['submitIssue'])) {

        $issueTitle = filter_input(INPUT_POST, 'issueSubject', FILTER_SANITIZE_SPECIAL_CHARS);
        $issue = filter_input(INPUT_POST, 'issue', FILTER_SANITIZE_SPECIAL_CHARS);
        $username = $_SESSION['login']->username;

        $db = Db::getdbInstantie();
        $db->submitIssue($issueTitle, $issue, $username);
        unset($_POST['submitIssue']);
    }

    if (isset($_POST['upload'])) {
        if ($_FILES['meme']['name'] !== "") {

            $checkSize = getimagesize($_FILES['meme']['tmp_name']);

            if ($checkSize['mime'] != "image/jpeg") {
                echo "<p class='alert alert-danger alert-dismissible'>This image type is not allowed!</p>";
                exit;
            }

            $temp = explode(".", $_FILES['meme']['name']);
            $newfilename = uniqid() . '.' . end($temp);
            $uploaddir = 'uploads/';

            $uploadfile = $uploaddir . $newfilename;


            if (move_uploaded_file($_FILES['meme']['tmp_name'], $uploadfile)) {
                $name = $newfilename;
                $dir = $uploaddir;
                $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
                $userID = $_SESSION['login']->userID;

                $db = Db::getdbInstantie();
                $db->uploadImage($name, $dir, $title, $userID);
                unset($_POST['upload']);
                header("Refresh:0");
            } else {
                echo "<p class='alert alert-danger alert-dismissible'>Image uploading failed.</p>";
            }

        }
    }

    if (isset($_POST['comment'])) {
        $memeID = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS);
        $userID = $_SESSION['login']->userID;
        $comment = filter_input(INPUT_POST, 'userComment', FILTER_SANITIZE_SPECIAL_CHARS);

        $db = Db::getdbInstantie();
        $db->submitComment($memeID, $userID, $comment);

        unset($_POST['comment']);
        unset($_POST['userComment']);
        header("Refresh:0");
    }

    getMemes();

    function getMemes()
    {
        $db = Db::getdbInstantie();
        $memes = $db->getMemes();

        if ($memes != null) {
            echo "<ul class='list-group mb-4'>";

            foreach ($memes as $meme) {
                $db = Db::getdbInstantie();
                $usernameInfo = $db->getUserWithParameter("userID", $meme->userID);
                $username = $usernameInfo->username;
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
                $i = 0;
                foreach ($comments as $comment) {
                    $commentorID = $comment->userID;
                    $commentor = $db->getUserWithParameter("userID", $commentorID )->username;
                    echo "<li class='list-unstyled p-2'>";
                    echo "<strong>@" . $commentor . "</strong> - <em>$comment->comment</em>";
                    echo "</li>";
                    $i++;
                }

                echo "</ul>";

                echo "<form method='post' enctype='multipart/form-data'><textarea name='userComment' placeholder='Place your comment here.' required class='form-control col-12 mb-2'></textarea>";
                echo "<button type='submit' name='comment' value='$meme->memeID' class='btn btn-primary'>Place comment</button>";
                echo "</form>";
                echo "</div>";
                echo "</li>";
            }


            echo "</ul>";

        }

    }

    ?>
</div>

<div id="chat" class=" col-3 d-inline-block align-top">
    <div class='jumbotron p-3'>
        <h2 class='display-4 text-center'>Chat</h2>
    </div>
    <form name="frmChat" id="frmChat">
        <div id="chat-box"></div>
        <input type="text" name="chat-message" id="chat-message" placeholder="Message" class="chat-input chat-message"
               required/>
        <input type="submit" id="btnSend" name="send-chat-message" value="Send" class="btn-primary">
    </form>
</div>

<footer class="mt-lg-5">
    Realised by Matthias Antierens, Jonathan de Mangelaere, Hugo Schless, Vital Van Hollebeke & Kenny Buffel
</footer>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/chat.js"></script>
</body>
</html>
