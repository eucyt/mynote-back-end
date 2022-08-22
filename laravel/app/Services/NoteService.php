<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class NoteService
{
    /**
     * Noteを取得
     * @param int $id
     * @return Note
     */
    public function find(int $id): Note
    {
        return Note::find($id);
    }


    /**
     * 公開済みNoteを取得
     * @param string $published_id
     * @return ?Note
     */
    public function findPublished(string $published_id): ?Note
    {
        $note = Note::where('published_id', $published_id)->firstOrFail();
        return $this->isPublished(($note)) ? $note : null;
    }


    /**
     * 公開にする
     * @param Note $note
     * @return ?string published_id
     */
    public function publish(Note $note): ?string
    {
        // these are not fillable
        $note->published_at = Carbon::now();

        // If the note has published before, previous published_id is used again.
        if (!isset($note->published_id)) {
            $note->published_id = Str::uuid();
        }

        return $note->update() ? route('notes.published', $note->published_id) : null;
    }


    /**
     * 非公開にする
     * @param Note $note
     * @return boolean
     */
    public function unpublish(Note $note): bool
    {
        $note->published_at = null;
        return $note->update();
    }


    /**
     * 公開済みNoteであるかどうか
     * @param Note $note
     * @return bool
     */
    private function isPublished(Note $note)
    {
        return isset($note->published_at);
    }
}
