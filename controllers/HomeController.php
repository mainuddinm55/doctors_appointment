<?php

namespace app\controllers;

use app\base\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->render('home');
    }

    public function dashboard()
    {
        var_dump($user);
        $this->render("dashboard", ["user" => $user]);
    }
}