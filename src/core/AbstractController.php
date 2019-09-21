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
     * @param array|null $body
     * @throws Exception
     */
    public function checkCsrf(array $body = null): void
    {
        $_check = $_POST;
        if (!empty($body)) {
            $_check = $body;
        }
        if (empty($_check['_csrf']) || $_check['_csrf'] !== $_SESSION['_csrf']) {
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