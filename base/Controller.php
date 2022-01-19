<?php

namespace app\base;

class Controller
{
    public string $action = '';

    public function render($view, $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }
}