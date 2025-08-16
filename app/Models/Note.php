<?php

namespace App\Models;

use Carbon\Carbon;
use Core\Database;

class Note
{
    public $id;

    public $user_id;

    public $title;

    public $note;

    public $created_at;

    public $updated_at;

    public function createdDate()
    {
        return Carbon::parse($this->created_at);
    }

    public function updatedDate()
    {
        return Carbon::parse($this->updated_at);
    }

    public function note()
    {
        if (session()->get('showNotes')) {
            return decrypt($this->note);
        }

        return str_repeat('*', rand(10, 100));
    }

    public static function all($search = null)
    {
        $database = new Database(config('database'));

        return $database->query(
            query: 'SELECT * FROM notes WHERE user_id = :user_id '.(
                $search ? 'AND title LIKE :search' : null
            ),
            params: array_merge(['user_id' => auth()->id], $search ? ['search' => "%$search%"] : []),
            class: self::class
        )->fetchAll();
    }

    public static function create($data)
    {
        $database = new Database(config('database'));

        $database->query(
            query: 'INSERT INTO notes (user_id, title, note, created_at, updated_at) VALUES (:user_id, :title, :note, :created_at, :updated_at)',
            params: array_merge($data, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ])
        );
    }

    public static function update($id, $title, $note)
    {
        $database = new Database(config('database'));

        $fieldsToUpdate = 'title = :title, updated_at = :updated_at';
        if ($note) {
            $fieldsToUpdate .= ', note = :note';
        }

        $database->query(
            query: "
        UPDATE 
          notes 
        SET 
          $fieldsToUpdate
        WHERE 
          id = :id
      ",
            params: array_merge([
                'id' => $id,
                'title' => $title,
                'updated_at' => date('Y-m-d H:i:s'),
            ], $note ? ['note' => encrypt($note)] : [])
        );
    }

    public static function delete($id)
    {
        $database = new Database(config('database'));

        $database->query(
            query: '
        DELETE FROM 
          notes 
        WHERE 
          id = :id
      ',
            params: ['id' => $id]
        );
    }
}
