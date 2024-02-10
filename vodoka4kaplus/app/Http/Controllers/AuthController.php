<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout()
    {
        auth('web')->logout();

        return redirect('/');
    }

    public function getName()
    {
        return auth()->user();
    }
}
