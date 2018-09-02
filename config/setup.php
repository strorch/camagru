<?php

//require_once '../serv/php/DB_connection.php';

class DB_connection
{
    private $host;
    private $database;
    private $user;
    private $passwd;

    public $DBH;

    public function __construct($host, $database, $user, $passwd)
    {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->passwd = $passwd;

        try {

            $this->DBH = new PDO("mysql:host=".$this->host.";port=3308;dbname=".$this->database, $this->user, $this->passwd);
        }
        catch(Exception $exception)
        {
            echo $exception->getMessage();
        }
    }
    public function __destruct(){}


    public  function exec($command)
    {
        $this->DBH->exec($command);
    }

    public function query($command)
    {
        return $this->DBH->query($command);
    }

    public function __toString()
    {
        return "1";
    }
}


$connection = new DB_connection("127.0.0.1", "camagru", "root", "123456");
