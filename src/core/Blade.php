<?php


namespace core;

class Blade
{
    /**
     * @var string
     */
    private $parent;

    protected $title;

    public function setTittle(string $title)
    {
        $this->title = $title;
    }
    public function getTittle(string $title)
    {
        return $this->title;
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
     * @param string $viewName
     * @param array $data
     * @param string|null $childString
     */
    public function render(string $viewName, array $data, ?string $childString = null)
    {
        $stringToRender = $this->getViewStringToRender($viewName, $data, $childString);
        if (empty($this->parent)) {
            echo $stringToRender;
            die();
        }
        $parentView = new Blade();
        $parentView->render($this->parent, $data, $stringToRender);
    }

    /**
     * @param string $code
     */
    public function renderError(string $code): void
    {
        require_once BLADES_DIR."/$code.php";
        die();
    }


    public function setParent(string $parent): void
    {
        $this->parent = $parent;
    }

    public function includeChild(string $name): void
    {
        echo $this->getViewStringToRender($name, []);
    }
}
