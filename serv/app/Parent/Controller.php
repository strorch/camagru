<?php

function dd($input)
{
    echo '<br>';
    var_dump($input);
    echo '<br>';
    die();
}

class Controller
{
    private $control;
    private $action;

    public function __construct()
    {

    }
}