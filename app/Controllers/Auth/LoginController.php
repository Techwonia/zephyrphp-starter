<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use ZephyrPHP\Core\Controllers\Controller;
use ZephyrPHP\Auth\Auth;
use ZephyrPHP\Security\Hash;
use ZephyrPHP\Security\Totp;
use ZephyrPHP\Security\Encryption;

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
            $user = Auth::user();

            // Check if 2FA is enabled for this user
            if ($user && method_exists($user, 'isTwoFactorEnabled') && $user->isTwoFactorEnabled()) {
                // Store user ID temporarily for 2FA verification
                $userId = $user->getAuthIdentifier();
                $rememberFlag = $remember;

                // Log the user out — they must pass 2FA first
                Auth::logout();

                // Store 2FA pending state in session
                $this->session->set('2fa_user_id', $userId);
                $this->session->set('2fa_remember', $rememberFlag);
                $this->session->set('2fa_expires', time() + 300); // 5-minute window

                $this->redirect('/zephyrphp/auth/2fa');
                return;
            }

            // No 2FA — proceed with normal login redirect
            $this->redirectAfterLogin();
            return;
        }

        $this->flash('errors', ['email' => 'These credentials do not match our records.']);
        $this->flash('_old_input', ['email' => $email]);
        $this->back();
    }

    /**
     * Show the 2FA challenge page
     */
    public function show2faChallenge(): string
    {
        $userId = $this->session->get('2fa_user_id');
        $expires = $this->session->get('2fa_expires', 0);

        // If no pending 2FA session or it expired, redirect to login
        if (!$userId || time() > $expires) {
            $this->session->remove('2fa_user_id');
            $this->session->remove('2fa_remember');
            $this->session->remove('2fa_expires');
            $this->redirect('/zephyrphp/auth/login');
            return '';
        }

        return $this->render('auth/2fa-challenge');
    }

    /**
     * Verify the 2FA code and complete login
     */
    public function verify2fa(): void
    {
        $userId = $this->session->get('2fa_user_id');
        $remember = $this->session->get('2fa_remember', false);
        $expires = $this->session->get('2fa_expires', 0);

        // Validate session state
        if (!$userId || time() > $expires) {
            $this->session->remove('2fa_user_id');
            $this->session->remove('2fa_remember');
            $this->session->remove('2fa_expires');
            $this->flash('error', 'Your 2FA session has expired. Please log in again.');
            $this->redirect('/zephyrphp/auth/login');
            return;
        }

        $code = trim($this->input('code', ''));
        $recoveryCode = trim($this->input('recovery_code', ''));

        if (empty($code) && empty($recoveryCode)) {
            $this->flash('errors', ['code' => 'Please enter a verification code or recovery code.']);
            $this->redirect('/zephyrphp/auth/2fa');
            return;
        }

        // Retrieve the user
        $userModel = $_ENV['AUTH_MODEL'] ?? 'App\\Models\\User';
        $user = $userModel::find($userId);

        if (!$user) {
            $this->session->remove('2fa_user_id');
            $this->session->remove('2fa_remember');
            $this->session->remove('2fa_expires');
            $this->flash('error', 'Authentication failed. Please log in again.');
            $this->redirect('/zephyrphp/auth/login');
            return;
        }

        $verified = false;

        // Try TOTP code verification
        if (!empty($code)) {
            try {
                $secret = Encryption::decrypt($user->getTwoFactorSecret());
                $verified = Totp::verify($secret, $code);
            } catch (\Exception $e) {
                // Decryption failure — treat as invalid
                $verified = false;
            }
        }

        // Try recovery code verification
        if (!$verified && !empty($recoveryCode)) {
            $verified = $this->verifyRecoveryCode($user, $recoveryCode);
        }

        if (!$verified) {
            $this->flash('errors', ['code' => 'The verification code is invalid or has expired.']);
            $this->redirect('/zephyrphp/auth/2fa');
            return;
        }

        // Clear 2FA session data
        $this->session->remove('2fa_user_id');
        $this->session->remove('2fa_remember');
        $this->session->remove('2fa_expires');

        // Log the user in
        Auth::loginUsingId($userId, $remember);

        $this->redirectAfterLogin();
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/zephyrphp/auth/login');
    }

    /**
     * Verify and consume a recovery code
     */
    private function verifyRecoveryCode(object $user, string $recoveryCode): bool
    {
        $storedCodes = $user->getTwoFactorRecoveryCodes();

        if (empty($storedCodes)) {
            return false;
        }

        $hashedCodes = json_decode($storedCodes, true);

        if (!is_array($hashedCodes)) {
            return false;
        }

        $normalizedInput = strtolower(trim($recoveryCode));

        foreach ($hashedCodes as $index => $hashedCode) {
            if (Hash::check($normalizedInput, $hashedCode)) {
                // Remove the used code
                unset($hashedCodes[$index]);
                $user->setTwoFactorRecoveryCodes(json_encode(array_values($hashedCodes)));
                $user->save();
                return true;
            }
        }

        return false;
    }

    /**
     * Handle post-login redirect based on intended URL and user role
     */
    private function redirectAfterLogin(): void
    {
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
            $this->redirect('/' . ltrim($_ENV['ADMIN_PATH'] ?? 'admin', '/'));
        } else {
            $this->redirect($_ENV['AUTH_HOME'] ?? '/');
        }
    }
}
