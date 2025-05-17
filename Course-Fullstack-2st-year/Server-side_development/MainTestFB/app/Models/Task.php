<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'deadline',
        'status',
    ];

    //Связь с таблицей User
    //task->belongsTo - каждая задача принадлежит одному пользователю
    public function user() {
        return $this->belongsTo(User::class);
    }

    //Связь с таблицей Categories
    //Таблица Task->belongsTo - каждая задача принадлежит одной категории
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
