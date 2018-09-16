<?php

class DB_connection
{
    public $DBH;

    public function __construct($DB_DSN, $DB_USER, $DB_PASSWORD)
    {
        try
        {
            $this->DBH = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        }
        catch (Exception $ex)
        {
            echo "DB crash";
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