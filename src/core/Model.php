<?php

declare(strict_types=1);

namespace core;

/**
 * Class Model
 * @package core
 */
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
    final public static function getInstance(string $className): self
    {
        $object = new $className();
        if (!($object instanceof Model)) {
            throw new \Exception('invalid model class name');
        }
        return $object;
    }
}
