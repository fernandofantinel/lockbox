<?php

namespace App\Controllers\Notes;

use App\Models\Note;

class IndexController
{
    public function __invoke()
    {
        $notes = Note::all(
            request()->get('search')
        );

        if (! $selectedNote = $this->getSelectedNote($notes)) {
            return view('notes/not-found');
        }

        return view('notes/index', [
            'notes' => $notes,
            'selectedNote' => $selectedNote,
        ]);
    }

    private function getSelectedNote($notes)
    {
        $id = request()->get('id', count($notes) > 0 ? $notes[0]->id : null);
        $filter = array_filter($notes, fn ($n) => $n->id == $id);

        return array_pop($filter);
    }
}
