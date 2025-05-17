<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    //Ниже перечислены связи с другими таблицами Task, Note, Goal
    //user->hasMany - один пользователь содержит много задач, целей и записок
    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
