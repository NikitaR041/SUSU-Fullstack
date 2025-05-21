<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; //Для authorize


class TaskController extends Controller
{
    use AuthorizesRequests; //Для authorize
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); //Загружаем все категории из бд
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //Проверка валидации
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'categories' => 'array'
    //     ]);

    //     //Создание новой задачи - загрузка в бд
    //     $task = Task::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'user_id' => Auth::id()
    //     ]);

    //     $task->categories()->attach($request->categories); //Связываение задачи с категорией
    //     return redirect()->route('dashboard');
    // }
    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'category' => 'nullable|string',
    ]);

    $task = new Task();
    $task->title = $request->input('title');
    $task->description = $request->input('description');
    $task->user_id = Auth::id();

    // Вот этот блок — вся "магия":
    $categoryName = $request->input('category');
    if ($categoryName) {
        $category = Category::firstOrCreate(
            ['name' => $categoryName] // ищем по name
        );
        $task->category_id = $category->id;
    }

    $task->save();

    return redirect()->route('dashboard')->with('success', 'Задача создана!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //Проверка "политики" - "имеет ли пользователь право редактировать задачу"
        $this->authorize('update', $task);

        $categories = Category::all(); //Загружаем все категории из бд
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categories' => 'array'
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        $task->categories()->sync($request->categories);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->categories()->detach();
        $task->delete();

        return redirect()->route('dashboard');
    }
}
