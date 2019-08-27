<?php


namespace core;


class View
{
    public function render(string $viewName, array $data)
    {
        foreach ($data as $name => $value) {
            $$name = $value;
        }
        require_once BLADES_DIR."/$viewName.php";
    }

    public function renderError(string $code): void
    {
        require_once BLADES_DIR."/$code.php";
        die();
    }
}