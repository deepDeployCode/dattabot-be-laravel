<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait AuthRepositories
{

    public function response()
    {
        return new Controller;
    }

    public function loginRepositories($request)
    {
        if ($email = User::whereemail($request->umail)->first()) {
            $user = $email;
        } else if ($username = User::whereusername($request->umail)->first()) {
            $user = $username;
        } else {
            return $this->response()->error('Invalid email/username');
        }

        if (!Hash::check($request->password, $user->password)) {
            $result = $this->response()->error('Invalid password');
        } else {
            $login = $user;
            $login['token'] = $login->createToken('dattabot')->accessToken;
            $result = $this->response()->ok($login, 'Succesfully Login');
        }
        return $result;
    }

    public function registerRepositories($request)
    {
        $user = $request->only('name', 'username', 'email', 'password');
        $user['password'] = Hash::make($request->password);
        return User::create($user);
    }

    public function logoutRepositories()
    {
        return Auth::guard('api')->user()->token()->delete();
    }
}
