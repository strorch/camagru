<?php


namespace core;


class View
{
//        foreach ($calculationResult as $name => $value) {
//            $$name = $value;
//        }
    public function render(string $viewName, array $data)
    {

    }

    public function renderError(string $code): void
    {
        require_once BLADES_DIR."/$code.php";
        die();
    }
}