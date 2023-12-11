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

    public function listUserRepositories($request)
    {
        $data = User::orderBy($request->sort ? $request->sort : 'id', $request->typeSort ? $request->typeSort : 'ASC')
            ->when($request->name, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->name}%");
            })
            ->when($request->username, function ($query) use ($request) {
                return $query->where('username', 'like', "%{$request->username}%");
            })
            ->when($request->email, function ($query) use ($request) {
                return $query->where('email', 'like', "%{$request->email}%");
            })
            ->paginate($this->response()->limit($request));

        return $data;
    }

    public function detailUserRepositories($id)
    {
        if ($detail = User::whereId($id)->first()) {
            $result = $this->response()->ok($detail);
        } else {
            $result = $this->response()->error('id users not found');
        }
        return $result;
    }
}
