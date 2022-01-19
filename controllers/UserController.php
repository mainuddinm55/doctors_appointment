<?php

namespace app\controllers;

use app\base\Controller;

class UserController extends Controller
{

    public function login()
    {
        return $this->render('login');
    }

    public function registration()
    {
        return $this->render('registration');
    }
}