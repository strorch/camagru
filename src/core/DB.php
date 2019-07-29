<?php

namespace core;

use PDO;
use PDOException;

class DB
{
    public $DBH;

    public function __construct()
    {
        $params = $this->getConnectionParams();
        $res = $this->getPDOConnection($params);
        if ($res['status'] === false) {
            throw new PDOException($res['message']);
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

    private function getDSN(array $params): string
    {
        return "pgsql:host={$params['DB_HOST']};dbname={$params['DB_NAME']};port={$params['DB_PORT']}";
    }

    private function getConnectionParams(): array
    {
        $params = include BASE_DIR . "/config/database.php";

        return [
            "DSN" => $this->getDSN($params),
            "user" => $params['DB_USER'],
            "passwd" => $params['DB_PASSWORD'],
        ];
    }
}
