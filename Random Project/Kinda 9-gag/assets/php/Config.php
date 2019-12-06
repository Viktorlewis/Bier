<?php

class Config
{
    private static $configInstantie = null;

    private $server;
    private $database;
    private $username;
    private $password;

    private function __construct()
    {
        $this->server = "localhost";
        $this->database = "Users";
        $this->username = "root";
        $this->password = "root";
    }

    public static function getConfigInstantie()
    {
        if(is_null(self::$configInstantie))
        {
            self::$configInstantie = new Config();
        }
        return self::$configInstantie;
    }

    public function getServer()
    {
        return $this->server;
    }
    public function getDatabase()
    {
        return $this->database;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }

}
