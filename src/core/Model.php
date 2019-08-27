<?php


namespace core;

interface ModelInterface
{

}


class Model implements ModelInterface
{
    protected $DB;

    public function __construct()
    {
//        $this->databaseInit();
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement __call() method.
    }

    private function databaseInit()
    {
        $this->DB = new DB();
    }
}
