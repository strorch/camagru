<?php


namespace core;


class View
{
    /**
     * TODO: work with strings - not with files
     */
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