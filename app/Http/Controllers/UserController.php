<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getRegistrate()
    {
        return view('registrate');
    }

    public function postRegistrate(Request $request)
    {
        $request->validate([
            'name' => 'required', // обязательный
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all(); // всё, что ввели в форму
        $this->create($data);
        return redirect(url("login"))->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password'); //возвращает элементы с указанными ключами

        if (Auth::attempt($credentials)) { // проверяет данные пользователя
            return redirect('main')->withSuccess('Signed in');
//            echo 'done';
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
