<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user(); //Подключение фасада Auth - взятие this текущего пользователя

        $categoryId = $request->query('category'); //Фильтрация задач по категориям

        //Задачи, которые именно связаны с пользователем
        // $tasks = Task::with('categories') //"подгрузить сразу и категории, связанные с каждой задачей"-избежать sql-запросов
        //             ->where('user_id', $user->id) //"показываем только задачи текущего пользователя, а не всех"
        //             ->when($categoryId, function ($query) use ($categoryId) { //"Если в URL есть параметр category, то дополнительно отфильтруй задачи, у которых есть нужная категория"
        //                 //"Найди только те задачи, которые привязаны к категории с id = $categoryId"
        //                 $query->whereHas('categories', function ($q) use ($categoryId) {
        //                     $q->where('categories.id', $categoryId);
        //                 });
        //             })
        //             ->get(); //Получение коллекции задач, соотвествующих фильтру

        $tasks = Task::with('category') // подгружаем одну категорию на задачу
            ->where('user_id', $user->id)
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId); // фильтрация по полю category_id
            })
            ->get();

        $categories = Category::all(); //Загружаем все категории

        //Возвращаем форму с двумя переменными
        return view('pages.dashboard', compact('tasks', 'categories'));
    }
}
