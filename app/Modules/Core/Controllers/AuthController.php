<?php

declare(strict_types=1);

namespace App\Modules\Core\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\RateLimiter;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\Validator;
use App\Shared\Config;
use App\Shared\View;
use PDO;

final class AuthController
{
    public function __construct(private PDO $db)
    {
    }

    public function showLogin(): Response
    {
        $branding = Config::get('branding');

        return Response::html(View::render('auth/login', [
            'branding' => $branding,
            'csrf' => Csrf::token(),
        ]));
    }

    public function login(Request $request): Response
    {
        $validator = new Validator();
        $email = $request->input('email');
        $password = $request->input('password');
        $token = $request->input('csrf_token');

        if (!Csrf::verify($token)) {
            return Response::html('Invalid CSRF token.', 419);
        }

        $validator->required('email', $email);
        $validator->required('password', $password);
        $validator->email('email', $email);

        if (!$validator->passes()) {
            Session::set('login_errors', $validator->errors());
            return Response::redirect('/login');
        }

        if (!RateLimiter::hit('login:' . $email, 5, 300)) {
            return Response::html('Too many attempts. Try again later.', 429);
        }

        $auth = new Auth($this->db);
        if (!$auth->attempt($email, $password)) {
            Session::set('login_errors', ['login' => 'Invalid credentials.']);
            return Response::redirect('/login');
        }

        return Response::redirect('/');
    }

    public function logout(): Response
    {
        $auth = new Auth($this->db);
        $auth->logout();

        return Response::redirect('/login');
    }
}
