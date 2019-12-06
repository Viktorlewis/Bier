<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-grid.css" rel="stylesheet">
    <link href="assets/css/bootstrap-reboot.css" rel="stylesheet">
<!--    <link rel="stylesheet" href="assets/css/screen.css">-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Index</title>
</head>

<body>
<?php session_start(); ?>
<div class="container">
<h1>Welkom <?php echo $_SESSION['login']->username ?></h1>
<p>Deze pagina zou enkel zichtbaar mogen zijn na het inloggen!</p>

<a href="assets/php/logout.php">Log out</a>

<h2 class='mt-5'>Issue Form</h2>
<form method="post" enctype="multipart/form-data" class="form-group">
    <input type="text" id="issueSubject" name="issueSubject" placeholder="Enter the issue subject" required autofocus class="form-control col-7 mb-2"/>

    <textarea name="issue" placeholder="Describe your issue here" required class="form-control col-7 mb-2"></textarea>
    <button type="submit" name="submitIssue" class="btn btn-default">Submit issue</button>
</form>

<h2 class='mt-5'>Meme upload</h2>

<form method="POST" enctype="multipart/form-data" class="form-group">
    <label>Select meme to upload:</label>
    <input type="file" name="meme" class=" col-7 mb-2">

    <label for="title" class="d-block">Add some text</label>
    <input type="text" id="title" name="title" class="form-control col-7 mb-2"/>
    <button type="submit" name="upload" value="upload" class="btn btn-default">Upload meme</button>
</form>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

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


//ISSUES
if (isset($_POST['submitIssue'])) {

    $issueTitle = filter_input(INPUT_POST, 'issueSubject', FILTER_SANITIZE_SPECIAL_CHARS);
    $issue = filter_input(INPUT_POST, 'issue', FILTER_SANITIZE_SPECIAL_CHARS);
    $username = $_SESSION['login']->username;

    $db = Db::getdbInstantie();
    $db->submitIssue($issueTitle, $issue, $username);
    unset($_POST['submitIssue']);
}

getMemes();

function getMemes()
{
    $db = Db::getdbInstantie();
    $memes = $db->getMemes();

    if ($memes != null){
        echo "<h2 class='mt-5'>Memes</h2>";
        echo "<ul class='list-group ml-2'>";

        foreach ($memes as $meme) {
            $db = Db::getdbInstantie();
            $username = $db->getUserWithParameter("userID", $meme->userID)->username;
            $src = $meme->directory . $meme->name;

            echo "<li class='list-group-item'>";

            echo "<p class='mb-0'><strong>@$username</strong></p>";
            echo "<p><em>$meme->title</em></p>";
            echo "<img src='$src' alt='$username' style='width: 400px' />";

            echo "</li>";
        }

        echo "</ul>";
    }

}

//MEMES
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
        } else {
            echo "<p class='alert alert-danger alert-dismissible'>Image uploading failed.</p>";
        }

    }
}

?>
</div>
</body>
</html>
