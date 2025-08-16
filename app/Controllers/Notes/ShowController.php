<?php

namespace App\Controllers\Notes;

use Core\Validation;

class ShowController
{
    public function confirm()
    {
        return view('notes/confirm');
    }

    public function show()
    {
        $validation = Validation::validate([
            'password' => ['required'],
        ], request()->all());

        if ($validation->notPassed()) {
            return view('notes/confirm');
        }

        if (! password_verify(request()->post('password'), auth()->password)) {
            flash()->push('validations', ['password' => ['Senha incorreta.']]);

            return view('notes/confirm');
        }

        session()->set('showNotes', true);

        return redirect('notes');
    }

    public function hide()
    {
        session()->forget('showNotes');

        return redirect('notes');
    }
}
