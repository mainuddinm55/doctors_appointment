<?php

namespace app\controllers;

use app\base\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->render('home');
    }
}