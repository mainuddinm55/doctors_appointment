<?php

namespace app\controllers;

use app\base\Controller;
use app\base\Request;
use app\base\Response;
use app\models\UserModel;
use Exception;
use Throwable;

class UserController extends Controller
{

    public function loginView()
    {
        $data = [
            "title" => "Login UI"
        ];
        return $this->render('login', $data);
    }

    public function attemptLogin(Request $request, Response $response)
    {
        $userModel = new UserModel();
        $userModel->loadData($request->getBody());
        try {
            $user = $userModel->login();
            session_start();
            $_SESSION["user"] = $user;
            $response->redirect("dashboard");
        } catch (Throwable $throwable) {
            $data = [
                "error"    => $throwable->getMessage(),
                "email"    => $userModel->email,
                "password" => $userModel->password
            ];
            return $this->render('login', $data);
        }
    }

    public function registrationView()
    {
        return $this->render('registration');
    }

    public function attemptRegistration(Request $request, Response $response)
    {
        $userModel = new UserModel();

        $userModel->loadData($request->getBody());
        try {
            $user = $userModel->registration();
            $response->redirect("dashboard");
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}