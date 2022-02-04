<?php

use app\base\Application;
use app\controllers\HomeController;
use app\controllers\UserController;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));
$app->router->get("/", [HomeController::class, 'index']);
$app->router->get("/dashboard", [HomeController::class, "dashboard"]);
$app->router->get('/login', [UserController::class, 'loginView']);
$app->router->post("/login", [UserController::class, 'attemptLogin']);
$app->router->get('/registration', [UserController::class, 'registrationView']);
$app->router->post(
    '/registration',
    [UserController::class, 'attemptRegistration']
);
$app->run();