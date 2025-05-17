<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'color',
    ];

    //Связь с таблицей Task
    // categories->hasMany - одна категория содержит много задач
    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
