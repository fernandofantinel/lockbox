<?php

namespace App\Controllers\Notes;

use App\Models\Note;
use Core\Validation;

class UpdateController
{
    public function __invoke()
    {
        $allowUpdateNote = session()->get('showNotes');

        $validation = Validation::validate(
            array_merge([
                'id' => ['required'],
                'title' => ['required', 'min:3', 'max:255'],
            ], $allowUpdateNote ? ['note' => ['required']] : []),
            request()->all()
        );

        if ($validation->notPassed()) {
            return redirect('/notes?id='.request()->post('id'));
        }

        Note::update(
            request()->post('id'),
            request()->post('title'),
            request()->post('note')
        );

        flash()->push('message', 'Nota atualizada com sucesso.');

        return redirect('/notes');
    }
}
