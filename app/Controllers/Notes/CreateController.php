<?php

namespace App\Controllers\Notes;

use App\Models\Note;
use Core\Validation;

class CreateController
{
    public function index()
    {
        return view('notes/create');
    }

    public function store()
    {
        $validation = Validation::validate([
            'title' => ['required', 'min:3', 'max:255'],
            'note' => ['required'],
        ], request()->all());

        if ($validation->notPassed()) {
            return view('notes/create');
        }

        Note::create([
            'user_id' => auth()->id,
            'title' => request()->post('title'),
            'note' => encrypt(request()->post('note')),
        ]);

        flash()->push('message', 'Nota criada com sucesso.');

        return redirect('/notes');
    }
}
