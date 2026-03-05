<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use ZephyrPHP\Core\Controllers\Controller;
use ZephyrPHP\Auth\Auth;
use ZephyrPHP\Hashing\Hash;
use App\Models\User;
use App\Models\Role;

class RegisterController extends Controller
{
    public function showRegisterForm(): string
    {
        return $this->render('auth/register');
    }

    public function register(): void
    {
        $name = $this->input('name', '');
        $email = $this->input('email', '');
        $password = $this->input('password', '');
        $passwordConfirm = $this->input('password_confirmation', '');

        $errors = [];

        if (empty($name)) {
            $errors['name'] = 'Name is required.';
        }
        if (empty($email)) {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        } elseif (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters.';
        }
        if ($password !== $passwordConfirm) {
            $errors['password_confirmation'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            $this->flash('errors', $errors);
            $this->flash('_old_input', ['name' => $name, 'email' => $email]);
            $this->back();
            return;
        }

        // Check if email already exists
        $existing = User::findOneBy(['email' => $email]);
        if ($existing) {
            $this->flash('errors', ['email' => 'This email is already registered.']);
            $this->flash('_old_input', ['name' => $name, 'email' => $email]);
            $this->back();
            return;
        }

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword(Hash::make($password));

        // First user gets admin role
        $allUsers = User::findAll();
        $isFirstUser = empty($allUsers);

        $user->save();

        if ($isFirstUser) {
            $this->assignAdminRole($user);
        }

        Auth::login($user);
        $this->redirect('/cms');
    }

    private function assignAdminRole(User $user): void
    {
        try {
            $adminRole = Role::findOneBy(['slug' => 'admin']);
            if (!$adminRole) {
                $adminRole = new Role();
                $adminRole->setName('Admin');
                $adminRole->setSlug('admin');
                $adminRole->setDescription('Administrator with full access');
                $adminRole->save();
            }

            $user->assignRole($adminRole);
        } catch (\Throwable $e) {
            // Role assignment is non-critical, continue
        }
    }
}
