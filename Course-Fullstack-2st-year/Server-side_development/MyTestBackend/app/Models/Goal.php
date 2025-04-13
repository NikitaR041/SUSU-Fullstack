<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'title',
        'description',
        'deadline',
    ];

    //Связь с таблицей User
    //goal->belongsTo - каждая цель принадлежит одному пользователю
    public function user() {
        return $this->belongsTo(User::class);
    }
}
