<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface AuthInterface
{
    public function login(Request $request);
    public function register(Request $request);
    public function logout();
    public function listUser(Request $request);
    public function detailUser($id);
}
