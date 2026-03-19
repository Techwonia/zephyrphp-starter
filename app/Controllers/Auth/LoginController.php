<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use ZephyrPHP\Core\Controllers\Controller;
use ZephyrPHP\Auth\Auth;

class LoginController extends Controller
{
    public function showLoginForm(): string
    {
        return $this->render('auth/login');
    }

    public function login(): void
    {
        $email = $this->input('email', '');
        $password = $this->input('password', '');
        $remember = $this->boolean('remember');

        $errors = [];

        if (empty($email)) {
            $errors['email'] = 'Email is required.';
        }
        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        }

        if (!empty($errors)) {
            $this->flash('errors', $errors);
            $this->flash('_old_input', ['email' => $email]);
            $this->back();
            return;
        }

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            // Check for intended URL first (user was trying to access a protected page)
            $intended = $this->session->get('url_intended', '/');
            $this->session->remove('url_intended');

            // Validate redirect target to prevent open redirect
            if (!str_starts_with($intended, '/') || str_starts_with($intended, '//')) {
                $intended = '/';
            }

            if ($intended && $intended !== '/') {
                $this->redirect($intended);
                return;
            }

            // Role-based default redirect
            $user = Auth::user();
            if ($user && method_exists($user, 'hasRole') && $user->hasRole('admin')) {
                $this->redirect('/cms');
            } else {
                $this->redirect($_ENV['AUTH_HOME'] ?? '/');
            }
            return;
        }

        $this->flash('errors', ['email' => 'These credentials do not match our records.']);
        $this->flash('_old_input', ['email' => $email]);
        $this->back();
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/login');
    }
}
