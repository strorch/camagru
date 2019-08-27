<?php


namespace core;


class View
{
    public function render()
    {

    }

    public function renderError(string $code)
    {
        require_once BLADES_DIR."/$code.php";
        die();
    }
}