<?php


namespace core;


abstract class AbstractController
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}