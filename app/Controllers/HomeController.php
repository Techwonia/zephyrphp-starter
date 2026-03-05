<?php

namespace App\Controllers;

use ZephyrPHP\Core\Controllers\Controller;
use ZephyrPHP\Auth\Auth;

class HomeController extends Controller
{
    /**
     * Display the home page or redirect to CMS
     */
    public function index()
    {
        if (Auth::check()) {
            $this->redirect('/cms');
            return '';
        }

        return $this->render('home');
    }
}
