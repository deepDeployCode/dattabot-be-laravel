<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface AuthInterface
{
    public function login(Request $request);
    public function register(Request $request);
    public function logout();
}
