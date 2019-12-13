<?php

include_once "Config.php";

class Db
{
    private static $dbInstantie = null;

    private $db;

    private function __construct()
    {
        try {
            $config = Config::getConfigInstantie();
            $server = $config->getServer();
            $database = $config->getDatabase();
            $username = $config->getUsername();
            $password = $config->getPassword();

            $this->db = new PDO("mysql:host=$server; dbname=$database", $username, $password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getdbInstantie()
    {
        if (is_null(self::$dbInstantie)) {
            self::$dbInstantie = new Db();
        }
        return self::$dbInstantie;
    }

    private function sluitDB()
    {
        self::$dbInstantie = null;
    }

    public function getUserWithParameter($parameter, $value)
    {
        $user = null;

        try {
            $sql = "select * from Users where " . $parameter . " = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(1, $value);

            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $user = $stmt->fetch(PDO::FETCH_OBJ);
            }

            $this->sluitDB();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $user;
    }

    public function login($username, $password, $url)
    {
        try {
            $user = $this->getUserWithParameter("username", $username);

            if (!is_null($user) && password_verify($password, $user->password)) {
                $_SESSION['login'] = $user;
                header('Location:' . $url);
            } else {
                echo "<p class='alert alert-danger alert-dismissible'>Username or password is incorrect.</p>";
            }

            $this->sluitDB();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public
    function register($user, $pass, $email)
    {
        try {
            if (isset($user) && isset($pass) && isset($email)) {
                $pass = password_hash($pass, PASSWORD_DEFAULT);

                $sql = "insert into Users(username, password, email) values(?,?,?)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(1, $user);
                $stmt->bindParam(2, $pass);
                $stmt->bindParam(3, $email);

                $stmt->execute();
                echo "<p class='alert alert-success alert-dismissible'>User " . $user . " has been created!</p>";
            }

            $this->sluitDB();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function submitIssue($issueTitle, $issue, $username)
    {
        try {
            if (isset($issueTitle) && isset($issue) && isset($username)) {

                $userID = $this->getUserWithParameter('username', $username)->userID;

                $sql = "INSERT INTO Feedback (`userID`, `title`, `issue`) VALUES (?, ?, ?);";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(1, $userID);
                $stmt->bindParam(2, $issueTitle);
                $stmt->bindParam(3, $issue);

                $stmt->execute();

                echo "<p class='alert alert-success alert-dismissible'>Your issue is succesfully submitted.</p>";
            }

            $this->sluitDB();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function getIssues($isSolved)
    {
        $issues = null;

        try {

            if (isset($isSolved)) {
                $sql = "select * from Feedback where solved = ?;";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(1, $isSolved);
                $stmt->execute();

                $issues = $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            $this->sluitDB();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $issues;
    }

    function issueSolved($issueID)
    {
        try {

            if (isset($issueID)) {
                $sql = "update Feedback set solved = 1 where issueID = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(1, $issueID);
                $stmt->execute();
            }
            $this->sluitDB();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    function uploadImage($name, $dir, $title, $userID)
    {
        try {

            if (isset($name) && isset($dir) && isset($title)) {
                $sql = "INSERT INTO Memes (`name`, `directory`, `title`, `userID`) VALUES (?, ?, ?, ?);";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(1, $name);
                $stmt->bindParam(2, $dir);
                $stmt->bindParam(3, $title);
                $stmt->bindParam(4, $userID);

                $stmt->execute();

                echo "<p class='alert alert-success alert-dismissible'>Image succesfully uploaded.</p>";
	        header("Refresh:0");
            }
            $this->sluitDB();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function getMemes()
    {
        $memes = null;

        try {

            $sql = "select * from Memes";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $memes = $stmt->fetchAll(PDO::FETCH_OBJ);

            $this->sluitDB();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $memes;
    }

}

