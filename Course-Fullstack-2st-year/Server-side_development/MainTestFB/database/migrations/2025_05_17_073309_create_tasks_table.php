<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //Связь с пользователем по внешнему ключу id
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); //Связь с категорией по внешнему ключу
            $table->string('title');
            $table->text('description')->nullable(); //->nullable - поле может быть пустым (без него laravel будет просить всегда что-то вводить в это поле)
            $table->datetime('start_date')->nullable(); //Начальная дата создания задачи
            $table->date('deadline')->nullable(); //До какого числа дедлайн
            $table->enum('status', ['pending', 'in_progress', 'done'])->default('pending'); //Статус задачи (Возможно лучше это сделать отдельной enum-класса)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
