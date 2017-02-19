<?php

namespace App\Http\Controllers\Auth;

use App\Usuario;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers,
        ThrottlesLogins;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest', [
            'except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:usuarios',
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected function create(array $data)
    {
        return Usuario::create([
            'email' => $data['email'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
