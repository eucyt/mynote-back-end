<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable =
        [
            'title',
            'body',
        ];


    /**
     * get user wrote this note
     * @return BelongsTo
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
