<?php

namespace App\Controllers\Notes;

use App\Models\Note;
use Core\Validation;

class DeleteController
{
    public function __invoke()
    {
        $validation = Validation::validate([
            'id' => ['required'],
        ], request()->all());

        if ($validation->notPassed()) {
            return redirect('/notes');
        }

        Note::delete(request()->post('id'));

        flash()->push('message', 'Nota removida com sucesso.');

        return redirect('/notes');
    }
}
