<?php

use app\base\Application;
use app\controllers\HomeController;
use app\controllers\UserController;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));
$app->router->get("/", [HomeController::class, 'index']);
$app->router->get('/login', [UserController::class, 'login']);
$app->router->get('/registration', [UserController::class, 'registration']);
$app->router->post('/registration', [UserController::class, 'attemptRegistration']);
$app->run();