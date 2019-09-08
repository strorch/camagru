<?php


namespace core;


class Model
{
    /**
     * @var DB
     */
    protected $DB;

    /**
     * Model constructor.
     */
    private function __construct()
    {
        $config = Application::getConfig();
        $this->DB = DB::get($config['db']);
    }

    /**
     * @param string $className
     * @return Model
     * @throws \Exception
     */
    final public static function getInstance(string $className): Model
    {
        $object = new $className();
        if (!($object instanceof Model)) {
            throw new \Exception('invalid model class name');
        }
        return $object;
    }
}
