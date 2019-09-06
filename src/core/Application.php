<?php

namespace core;

class Application
{
    /**
     * @var mixed[] $config
     */
    private static $config;

    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        static::$config = $config;
    }

    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return static::$config;
    }

    /**
     * Main application method
     */
    public static function run(): void
    {
        try {
            session_start();

            $view = new View();
            $model = Model::getInstance(Model::class);
            $controller = new ApplicationController($model, $view);

            $controller->handleRequest();
        }
        catch (\Throwable $e) {
            echo json_encode($e->getMessage());
        }
    }
}
