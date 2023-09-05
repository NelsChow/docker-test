<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function createToken()
    {
        $token = auth()
            ->user()
            ->createToken('authToken')->accessToken;
        return response()->json(['token' => $token]);
    }
}
