<?php

declare(strict_types=1);

namespace core;

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
     * @param string $to
     */
    public function redirect(string $to): void
    {
        header('Location: ' . $to);
    }
}