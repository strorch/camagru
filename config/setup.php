#!/usr/bin/php

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

            $this->DBH = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->user, $this->passwd);
        }
        catch(Exception $exception)
        {
            print($exception);
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

$connection = new DB_connection("localhost", "taskom_test", "root", "123456");

$row = 1;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num полей в строке $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}

