<?php


namespace core;


class Model
{
    /**
     * @var DB
     */
    protected $DB;

    private function __construct()
    {
        $config = Application::getConfig();
        $this->DB = DB::get($config['db']);
    }

    public static function getInstance(string $className): Model
    {
        $object = new $className();
        if (!($object instanceof Model)) {
            throw new \Exception('invalid model class name');
        }
        return $object;
    }
}
