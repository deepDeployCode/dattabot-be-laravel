<?php

namespace App\Http\Controllers;

use App\Interface\AuthInterface;
use Illuminate\Http\Request;
use App\Repositories\AuthRepositories;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller implements AuthInterface
{
    use AuthRepositories;

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'umail' => 'required', //key umail for login username or email
            'password' => 'required',
        ]);
        if ($validate->fails()) {
            return $this->customError($validate->errors());
        } else {
            return $this->loginRepositories($request);
        }
    }

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
        ]);
        if ($validate->fails()) {
            return $this->customError($validate->errors());
        } else {
            return $this->ok($this->registerRepositories($request), 'Successfully Register');
        }
    }

    public function logout()
    {
        return $this->ok($this->logoutRepositories(), 'Successfully Logout');
    }
}
