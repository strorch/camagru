<?php

declare(strict_types=1);

namespace core;


use Exception;

/**
 * Class AbstractController
 * @package core
 */
abstract class AbstractController
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * AbstractController constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @throws Exception
     */
    public function checkCsrf(): void
    {
        if (empty($_POST['_csrf']) || $_POST['_csrf'] !== $_SESSION['_csrf']) {
            throw new Exception('page is not available');
        }
    }

    /**
     * @param string $to
     */
    public function redirect(string $to): void
    {
        header('Location: ' . $to);
        die();
    }
}