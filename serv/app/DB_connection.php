<?php

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
        try
        {
            $this->DBH = new PDO("mysql:host=$host;dbname=$database", $user, $passwd);
        }
        catch (Exception $ex)
        {
            echo "crash";
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