<?php

class DB
{
    public $DBH;

    public function __construct()
    {
        $params = $this->getConnectionParams();
        $res = $this->getPDOConnection($params);
        if ($res['status'] === false) {
            echo $res['message'];
            die;
        }
    }

    public  function query($command, $params = null)
    {
        if (is_null($params))
        {
            $res = $this->DBH->query($command);
            return $res->fetchAll();
        }
        $prepared = $this->DBH->prepare($command);
        $prepared->execute( $params);
        return $prepared->fetchAll();
    }

    public  function exec($command, $params = null)
    {
        if (is_null($params))
        {
            $this->DBH->exec($command);
        }
        $prepared = $this->DBH->prepare($command);
//        $prepared->execute($params);
//        print_r($this->DBH->errorInfo());
    }
    private function getPDOConnection($params)
    {
        try
        {
            $this->DBH = new PDO($params['DSN'], $params['user'], $params['passwd']);
            $this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return [
                'status'=> true
            ];
        }
        catch (PDOException $ex)
        {
            return [
                'status'=> false,
                'message' => $ex->getMessage()
            ];
        }
    }

    private function getConnectionParams()
    {
        require ROOTPATH . "/config/database.php";

        return [
            "DSN" => $DB_DSN,
            "user" => $DB_USER,
            "passwd" => $DB_PASSWORD
        ];
    }
}