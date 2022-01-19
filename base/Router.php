<?php

namespace app\base;

class Router
{
    private Request $request;
    private Response $response;
    private array $routeMap = [];

    /**
     * @param Request  $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $url, $callback)
    {
        $this->routeMap['get'][$url] = $callback;
    }

    public function post(string $url, $callback)
    {
        $this->routeMap['post'][$url] = $callback;
    }

    /**
     * @throws \Exception
     */
    public function resolve()
    {
        $method = $this->request->method();
        $url = $this->request->getUrl();
        $callback = $this->routeMap[$method][$url] ?? false;
        if ( ! $callback) {
            throw new \Exception("Not found");
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0];
            $controller->action = $callback[1];
            Application::$app->controller = $controller;
            $callback[0] = $controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView(string $view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }


}