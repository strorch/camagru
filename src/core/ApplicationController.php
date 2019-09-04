<?php


namespace core;


class ApplicationController
{
    private $model;

    private $view;

    public function __construct(Model $model, View $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleRequest(): void
    {
        $calculationResult = $this->callRoutes();
        if (empty($calculationResult['data'])) {
            throw new \Exception('invalid result array');
        }
        if (empty($calculationResult['view'])) {
            echo json_encode($calculationResult['data']);
            die();
        }
        $this->createCsrfToken();
        $this->view->setViewName($calculationResult['view']);
        $this->view->setData($calculationResult['data']);
        $this->view->render();
    }

    private function createCsrfToken()
    {
        if (empty($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
        }
    }

    private function callRoutes(): array
    {
        include SRC_DIR . '/routes.php';
        $DI = Router::getDI();
        if (empty($DI)) {
            $this->view->renderError('404');
        }
        $class = $DI['class'];
        $controllerPath = "controllers\\$class";
        $controller = new $controllerPath($this->model);

        return $controller->{$DI['method']}();
    }
}
