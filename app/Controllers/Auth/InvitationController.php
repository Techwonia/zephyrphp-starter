<?php

declare(strict_types=1);

namespace App\Controllers\Auth;

use ZephyrPHP\Core\Controllers\Controller;
use ZephyrPHP\Auth\Auth;
use ZephyrPHP\Security\Hash;
use ZephyrPHP\Cms\Models\Invitation;
use App\Models\User;

class InvitationController extends Controller
{
    /**
     * GET /zephyrphp/auth/invite/accept?token=xxx&email=xxx
     * Show registration form pre-filled with email.
     */
    public function showAcceptForm(): string
    {
        $token = $this->query('token', '');
        $email = $this->query('email', '');

        if (empty($token) || empty($email)) {
            $this->flash('error', 'Invalid invitation link.');
            $this->redirect('/zephyrphp/auth/login');
            return '';
        }

        // Verify the invitation exists and is valid
        $invitation = $this->findValidInvitation($email, $token);
        if (!$invitation) {
            $this->flash('error', 'This invitation link is invalid or has expired.');
            $this->redirect('/zephyrphp/auth/login');
            return '';
        }

        return $this->render('auth/accept-invite', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    /**
     * POST /zephyrphp/auth/invite/accept
     * Validate token, create user, assign role, mark invitation accepted.
     */
    public function accept(): void
    {
        $this->validateCSRF();

        $token = $this->input('token', '');
        $email = strtolower(trim($this->input('email', '')));
        $name = trim($this->input('name', ''));
        $password = $this->input('password', '');
        $passwordConfirmation = $this->input('password_confirmation', '');

        $errors = [];

        if (empty($token) || empty($email)) {
            $errors['token'] = 'Invalid invitation link.';
        }

        if (empty($name)) {
            $errors['name'] = 'Name is required.';
        }

        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        } elseif (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters.';
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $errors['password'] = 'Password must contain at least one uppercase letter.';
        } elseif (!preg_match('/[a-z]/', $password)) {
            $errors['password'] = 'Password must contain at least one lowercase letter.';
        } elseif (!preg_match('/[0-9]/', $password)) {
            $errors['password'] = 'Password must contain at least one number.';
        }

        if ($password !== $passwordConfirmation) {
            $errors['password_confirmation'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            $this->flash('errors', $errors);
            $this->flash('_old_input', ['name' => $name, 'email' => $email]);
            $this->redirect('/zephyrphp/auth/invite/accept?token=' . urlencode($token) . '&email=' . urlencode($email));
            return;
        }

        // Verify the invitation
        $invitation = $this->findValidInvitation($email, $token);
        if (!$invitation) {
            $this->flash('error', 'This invitation link is invalid or has expired.');
            $this->redirect('/zephyrphp/auth/login');
            return;
        }

        // Check if user already exists
        $existing = User::findOneBy(['email' => $email]);
        if ($existing) {
            $this->flash('error', 'An account with this email already exists. Please sign in instead.');
            $this->redirect('/zephyrphp/auth/login');
            return;
        }

        // Create the user
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword(Hash::make($password));
        $user->save();

        // Assign role if specified
        if ($invitation->getRoleId()) {
            $roleClass = $this->getRoleModel();
            if ($roleClass) {
                $role = $roleClass::find($invitation->getRoleId());
                if ($role) {
                    $user->assignRole($role);
                    $user->save();
                }
            }
        }

        // Mark invitation as accepted
        $invitation->setAcceptedAt(new \DateTime());
        $invitation->save();

        // Auto-login
        Auth::loginUsingId($user->getId());

        // Redirect to admin
        $adminPath = '/' . ltrim($_ENV['ADMIN_PATH'] ?? 'admin', '/');
        $this->redirect($adminPath);
    }

    /**
     * Find a valid (non-expired, non-accepted) invitation matching email and token.
     */
    private function findValidInvitation(string $email, string $plainToken): ?Invitation
    {
        $invitations = Invitation::findBy([
            'email' => strtolower($email),
            'acceptedAt' => null,
        ]);

        foreach ($invitations as $invitation) {
            if ($invitation->isExpired()) {
                continue;
            }
            if (Hash::check($plainToken, $invitation->getToken())) {
                return $invitation;
            }
        }

        return null;
    }

    /**
     * Detect the Role model class.
     */
    private function getRoleModel(): ?string
    {
        $roleClass = 'App\\Models\\Role';
        return class_exists($roleClass) ? $roleClass : null;
    }
}
