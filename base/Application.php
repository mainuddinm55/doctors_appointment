<?php

namespace app\base;

use Exception;

class Application
{
    public static string $ROOT_DIR;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public View $view;

    public function __construct($rootPath)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (Exception $exception) {
            echo $exception;
        }
    }
}