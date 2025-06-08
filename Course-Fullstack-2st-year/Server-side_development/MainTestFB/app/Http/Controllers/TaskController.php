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
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category' => 'nullable|string|max:255',
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
    public function show($id) {
        // $task = Task::findOrFail($id);
        $task = Task::where('id', $id)
                ->where('user_id', Auth::id()) // ✅ Правильный вызов
                ->firstOrFail();
        return view('pages.task', compact('task'));
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
    // public function update(Request $request, Task $task)
    // {
    //     // $task = Task::findOrFail($id);
    //     // $task->title = $request->title;
    //     // $task->description = $request->description;
    //     // $task->save();
    //     // return response()->json(['success' => true]);
    //     $this->authorize('update', $task); // если используются политики
    //     if ($task->title === $request->title && $task->description === $request->description && $task->category->name === $request->category) {
    //         return redirect()->route('dashboard'); // Переход на рабочий стол
    //     }

    //     $task->title = $request->title;
    //     $task->description = $request->description;
    //     $task->category = $request->category;
    //     $task->save();
    //     return response()->json(['success' => true]);
    // }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->title = $request->title;
        $task->description = $request->description;

        // Обновляем категорию
        $categoryName = $request->input('category');
        if ($categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName]);
            $task->category_id = $category->id;
        }

        $task->save();

        return redirect()->route('dashboard')->with('success', 'Задача обновлена!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // $this->authorize('delete', $task);
        // $task->categories()->detach();
        // $task->delete();
        // return redirect()->route('dashboard');

        $this->authorize('delete', $task); // Проверка политики
        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Задача удалена.');
    }
    // public function destroy($id)
    // {
    //     $task = Task::findOrFail($id);
    //     $task->delete();
    //     return redirect()->route('dashboard')->with('success', 'Задача удалена!');
    //     // return response()->json(['success' => true]);
    // }

}
