<?php

namespace app\controllers;

use app\base\Controller;
use app\base\Request;
use app\base\Response;
use app\models\UserModel;
use Exception;

class UserController extends Controller
{

    public function login()
    {
        $data = [
            "title" => "Login UI"
        ];
        return $this->render('login', $data);
    }

    public function registration()
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