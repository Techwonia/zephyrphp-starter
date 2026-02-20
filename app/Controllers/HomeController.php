<?php

namespace App\Controllers;

use ZephyrPHP\Core\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index(): string
    {
        return $this->render('home');
    }
}
