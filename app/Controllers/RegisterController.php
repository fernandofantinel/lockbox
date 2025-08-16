<?php

namespace App\Controllers;

use Core\Database;
use Core\Validation;

class RegisterController
{
    public function index()
    {
        return view('register', template: 'guest');
    }

    public function register()
    {

        $validation = Validation::validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'confirmed', 'unique:users'],
            'password' => ['required', 'min:8', 'strong'],
        ], request()->all());

        if ($validation->notPassed()) {
            return view('register', template: 'guest');
        }

        $database = new Database(config('database'));

        $database->query(
            query: 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)',
            params: [
                'name' => request()->post('name'),
                'email' => request()->post('email'),
                'password' => password_hash(request()->post('password'), PASSWORD_BCRYPT),
            ]
        );

        flash()->push('message', 'Registrado com sucesso.');

        return redirect('login');
    }
}
