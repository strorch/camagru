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
//
//    $to_stikers = "./public/stikers/";
//    $return = [];
//    $return[0] = "mem1.jpg";
//    $return[1] = "mem2.jpeg";
//    $return[2] = "mem3.jpg";
//    $return[3] = "mem4.jpg";
//    $return[4] = "mem5.jpg";
//    $return[5] = "mem6.jpg";

//$return = [];
//$return[0] = base64_encode(file_get_contents("./public/stikers/mem1.jpg"));
//$return[1] = base64_encode(file_get_contents("./public/stikers/mem2.jpeg"));
//$return[2] = base64_encode(file_get_contents("./public/stikers/mem3.jpg"));
//$return[3] = base64_encode(file_get_contents("./public/stikers/mem4.jpg"));
//$return[4] = base64_encode(file_get_contents("./public/stikers/mem5.jpg"));
//$return[5] = base64_encode(file_get_contents("./public/stikers/mem6.jpg"));
//
//    $DB = new DB_connection("localhost", "camagru", "root", "123456");
//
//    for ($i = 0; $i < 6; $i++)
//    {
//        $DB->exec("INSERT INTO `posts` (USER, PICT) VALUES ('kek', '".$to_stikers.$return[$i]."');<br/>");
//    }
