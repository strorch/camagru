<?php

declare(strict_types=1);

namespace core;


use core\Router\Router;

/**
 * Class ApplicationController
 * @package core
 */
class ApplicationController
{
    /**
     * @var Model
     */
    private $model;

    /**
     * @var View
     */
    private $view;

    /**
     * ApplicationController constructor.
     * @param Model $model
     * @param View $view
     */
    public function __construct(Model $model, View $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    /**
     * @throws \Exception
     */
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

    /**
     * @throws \Exception
     */
    private function createCsrfToken(): void
    {
        if (empty($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
        }
    }

    /**
     * @return mixed[]
     */
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
