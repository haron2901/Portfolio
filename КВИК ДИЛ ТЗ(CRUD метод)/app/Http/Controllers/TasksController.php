<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
class TasksController extends Controller
{
    #входные данные : title, content
    public function create
    (
        Request $request
    )
    {
        $data = $request->toArray();

        $existingTask = Tasks::where('title', $data['title'])->first();

        if ($existingTask) {
            return response()->json(['error' => 'Задача с таким названием уже существует'], 400);
        }

        $task = new Tasks();

        $task->title = $data['title'];
        $task->content = $data['content'];

        $task->save();


        return response()->json(['message' => 'Задача успешно создана']);
    }

    #В данном случае вы должны отправить через json title(задачу которую хотите получить)
    public function get
    (
        Request $request
    )
    {
        $data = $request->toArray();

        $task = Tasks::where('title', $data['title'])->first();

        if ($task) {
            return response()->json($task);
        } else {
            return response()->json(['message' => 'Такого нету :('], 404);
        }

    }
    public function getByDate(Request $request)
    {
        $tasks = Tasks::orderBy('created_at', 'asc')->get();

        return response()->json($tasks);
    }
    #Тут вы должны отправить старое имя(OldTitle),новое имя(если нет необходимости его менять, отправьте пустой json("newTitle": ""), так же с контентом ("content": ""))
    #Обратите внимание что нельзя не отправить эти данные( то есть надо отправить даже пустыми)
    public function edit
    (
        Request $request
    )
    {
        $data = $request->toArray();

        $task = Tasks::where('title', $data['OldTitle'])->first();

        if(!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        if(isset($data['newTitle']) && !empty($data['newTitle'])) {
            $task->title = $data['newTitle'];
        }

        if(isset($data['content']) && !empty($data['content'])) {
            $task->content = $data['content'];
        }

        $task->save();

        return response()->json(['message' => 'Task updated successfully']);
    }
}
