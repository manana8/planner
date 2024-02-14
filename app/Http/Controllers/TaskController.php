<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TaskController
{
    public function getActiveTasks()
    {
        $userId = Auth::id();
        $tasks = Task::with('category')->get()->where('user_id', $userId)->whereNull('data_of_done')->sortByDesc('deadline');

        return view('main', ['tasks' => $tasks]);
    }

    public function getDoneTasks()
    {
        $userId = Auth::id();
        $tasks = Task::with('category')->get()->where('user_id', $userId)->whereNotNull('data_of_done')->sortBy('data_of_done');

        return view('main', ['tasks' => $tasks]);
    }

    public function addTask(Request $request)
    {
        $request->validate([
            'title' => 'required|max:250', // обязательный
            'text' => 'required',
            'category_id' => 'required',
            'deadline' => 'required',
            'status' => 'required',
        ]);

        $data = $request->all(); // всё, что ввели в форму
        $this->create($data);

//        return redirect(url("main"));
        return view('addingTask');
    }

    public function create(array $data)
    {
        return Task::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'text' => $data['text'],
            'category_id' => $data['category_id'],
            'deadline' => $data['deadline'],
            'status' => $data['status'],
            'data_of_create' => date('Y-m-d H:i:s'),
        ]);
    }

    public function doneTask(Request $request)
    {
        $task_id = $request->get('id');

        dd($task_id);
        Task::where('id', $task_id)->update([
            'data_of_done' => date('Y-m-d H:i:s')
        ]);

        return redirect(url("main"));
    }
}
