<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register', [
            'headerLink' => 'login',
            'headerLinkUrl' => '/login',
        ]);
    }

    public function login()
    {
        return view('auth.login', [
            'headerLink' => 'register',
            'headerLinkUrl' => '/register',
        ]);
    }
}
