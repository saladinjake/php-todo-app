<?php

namespace Controllers;


use App\View;
use App\Middleware;
use Models\Auth;

class AuthController
{
    /**
     * Registeration from
     *
     * @return void
     */
    public function registerForm()
    {
        if (!is_null(Middleware::init(__METHOD__))) {
            header('location: ' . URL_ROOT, true, 303);
            exit();
        }

        Helper::render(
            'auth/register',
            [
                'page_title' => 'Register',
                'page_subtitle' => 'Register to send post in Blog'
            ]
        );
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Login from
     *
     * @return void
     */
    public function loginForm()
    {
        if (!is_null(Middleware::init(__METHOD__))) {
            header('location: ' . URL_ROOT, true, 303);
            exit();
        }

        Helper::render(
            'auth/login',
            [
                'page_title' => 'Login',
                'page_subtitle' => 'Login to send post in Blog'
            ]
        );
    }

    /**
     * Login
     *
     * @return void
     */
    public function login()
    {

    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        $output = [];

        if (is_null(Middleware::init(__METHOD__))) {
            $output['status'] = 'ERROR';
            $output['message'] = 'Authentication failed!';
        } elseif (Auth::logout()) {
            header('location: ' . URL_ROOT, true, 303);
            exit();
        } else {
            $output['status'] = 'ERROR';
            $output['message'] = 'Logout Failed!';
        }

        echo json_encode($output);
    }
}
