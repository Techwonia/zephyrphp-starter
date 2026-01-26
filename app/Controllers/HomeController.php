<?php

namespace App\Controllers;

use ZephyrPHP\Core\Controllers\Controller;

class HomeController extends Controller
{
    public function index(): string
    {
        return $this->render('welcome');
    }
}
