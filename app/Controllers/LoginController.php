<?php

namespace App\Controllers;

use App\Models\User;
use Core\Database;
use Core\Validation;

class LoginController
{
    public function index()
    {
        return view('login', template: 'guest');
    }

    public function login()
    {
        $email = request()->post('email');
        $password = request()->post('password');

        $validation = Validation::validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], request()->all());

        if ($validation->notPassed()) {
            return view('login', template: 'guest');
        }

        $database = new Database(config('database'));

        $user = $database->query(
            query: 'SELECT * FROM users WHERE email = :email',
            class: User::class,
            params: compact('email')
        )->fetch();

        if (! $user && password_verify($password, $user->password)) {
            flash()->push('validations', ['email' => ['Dados incorretos.']]);

            return view('login', template: 'guest');
        }

        session()->set('auth', $user);

        flash()->push('message', 'Seja bem-vindo, '.$user->name);

        return redirect('/notes');
    }
}
