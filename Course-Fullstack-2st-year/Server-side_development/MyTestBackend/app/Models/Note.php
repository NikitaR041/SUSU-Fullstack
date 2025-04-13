<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    //Связь с таблицей User
    //note->belongsTo - каждая записка принадлежит одному пользователю
    public function user() {
        return $this->belongsTo(User::class);
    }
}
