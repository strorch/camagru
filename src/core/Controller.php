<?php


namespace core;


class Controller
{
    private $model;

    private $view;

    public function __construct(Model $model, View $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleRequest()
    {
        $this->callRoutes();
    }

    private function callRoutes()
    {
        include SRC_DIR . '/routes.php';
        $DI = Router::getDI();
        if (empty($DI)) {
            $this->view->renderError('404');
        }
        $class = $DI['class'];
        $controllerPath = CONTROLLERS_DIR . "/$class.php";
//        Utils::print_r([$controllerPath]);
        include $controllerPath;
        $method = $DI['method'];
        $tmp = new $class();
        $tmp->{$method}();
    }
}