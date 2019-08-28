<?php


namespace core;


class View
{
    /**
     * @var View
     */
    protected $parent;

    public function setParent(View $parent): void
    {
        $this->parent = $parent;
    }

    protected function someRecursive()
    {

    }

    private function getStringToRender(string $viewName, array $data): string
    {
        foreach ($data as $name => $value) {
            $$name = $value;
        }
        ob_start();
        require_once BLADES_DIR."/$viewName.php";
        $renderedBlade = ob_get_clean();
        return $renderedBlade;
    }
    /**
     * @param string $viewName
     * @param array $data
     */
    public function render(string $viewName, array $data)
    {
        $stringToRender = $this->getStringToRender($viewName, $data);
        echo $stringToRender;
    }

    /**
     * @param string $code
     */
    public function renderError(string $code): void
    {
        require_once BLADES_DIR."/$code.php";
        die();
    }
}