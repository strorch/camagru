<?php


namespace App\Infrastructure\DB;


use PDO;
use PDOException;

final class DB
{
    private $dbParams;

    private $connection;

    private function __construct(array $dbParams)
    {
        $this->dbParams = $dbParams;
        $this->validateParams();
    }

    public static function get(array $dbParams): self
    {
        $DB = new static($dbParams);

        $DB->connection = new PDO($DB->getDSN(), $DB->getUser(), $DB->getPassword());
        $DB->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $DB;
    }

    public function exec($command, $params = null): void
    {
        if (empty($params)) {
            $this->connection->exec($command);
            return;
        }
        $prepared = $this->connection->prepare($command);
        $prepared->execute($params);
    }

    public function query($command, $params = null)
    {
        if (empty($params)) {
            $res = $this->connection->query($command);
            return $res->fetchAll();
        }
        $prepared = $this->connection->prepare($command);
        $res = $prepared->query($params);
        return $res->fetchAll();
    }

    private function getDSN(): string
    {
        $params = $this->dbParams;
        return "{$params['type']}:host={$params['host']};dbname={$params['dbName']};port={$params['port']}";
    }

    private function getUser(): string
    {
        return $this->dbParams['user'];
    }

    private function getPassword(): string
    {
        return $this->dbParams['password'];
    }

    private function validateParams(): void
    {
        foreach (['type', 'host', 'port', 'dbName', 'user', 'password'] as $value) {
            if (empty($this->dbParams[$value])) {
                throw new PDOException("DB param '$value' is empty");
            }
        }
    }
}

