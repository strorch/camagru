<?php


namespace core;

class View
{
    /**
     * @return ?string
     */
    private $parent;

    private $viewName;

    private $data;

    /**
     * @param string $viewName
     */
    public function setViewName(string $viewName): void
    {
        $this->viewName = $viewName;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function setParent(string $parent): void
    {
        $this->parent = $parent;
    }

    private function getViewStringToRender(string $viewName, array $data, ?string $childString = null): string
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
     * @param string|null $childString
     */
    public function render(?string $childString = null)
    {
        $viewName = $this->viewName;
        $data = $this->data;
        $stringToRender = $this->getViewStringToRender($viewName, $data, $childString);
        if (empty($this->parent)) {
            echo $stringToRender;
            die();
        }
        $parentView = new View();
        $parentView->setData($data);
        $parentView->setViewName($this->parent);
        $parentView->render($stringToRender);
    }

    /**
     * @param string $code
     */
    public function renderError(string $code): void
    {
        require_once BLADES_DIR."/$code.php";
        die();
    }

    public function includeChild(string $name): void
    {
        echo $this->getViewStringToRender($name, $this->data);
    }
}
