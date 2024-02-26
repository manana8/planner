<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskComment;
use App\Models\TaskHistory;
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
        $tasks = Task::with('category')->get()->where('user_id', $userId)->whereNotNull('data_of_done')->sortByDesc('data_of_done');

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
        $task = $this->create($data);

        $taskId = $task->id;
        $this->createTaskHistory($data, $taskId);
    }

    public function createTaskHistory(array $data, int $taskId)
    {
        return TaskHistory::create([
            'data_of_history_create' => date('Y-m-d H:i:s'),
            'task_id' => $taskId,
            'title_before' => $data['title'],
            'text_before' => $data['text'],
            'category_id_before' => $data['category_id'],
            'deadline_before' => $data['deadline'],
            'status_before' => $data['status'],
            'type' => 'CREATE',
        ]);
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

    public function doneTask(int $taskId)
    {
        $task = Task::where('id', '=', $taskId)->first();
        $task->update([
            'data_of_done' => date('Y-m-d H:i:s')
        ]);

        TaskHistory::create([
            'data_of_history_create' => date('Y-m-d H:i:s'),
            'task_id' => $taskId,
            'type' => 'Done',
        ]);

        return redirect(url("main"));
    }

    public function editTaskForm(int $taskId)
    {
        $task = Task::where('id', '=', $taskId)->first();

        return view("editingTask", ['task' => $task]);
    }

    public function editTask(Request $request, int $taskId)
    {
        $task = Task::where('id', '=', $taskId)->first();

        $task->update([
            'title' => $request['title'],
            'text' => $request['text'],
            'category_id' => $request['category_id'],
            'deadline' => $request['deadline'],
            'status' => $request['status'],
        ]);

        $data = $request->all();
        $history = $this->createTaskHistory($data, $taskId);
        $historyId = $history->id;
        TaskHistory::where('task_id', '=', $taskId)->where('id', '=', $historyId)->update([
            'type' => 'CHANGE',
        ]);
    }

    public function deleteTask(int $taskId)
    {
        Task::where('id', '=', $taskId)->first()->delete();

        return redirect(url("main"));
    }

    public function getHistory(int $taskId)
    {
        $taskHistories = TaskHistory::where('task_id', '=', $taskId)->get()->sortBy('data_of_history_create');

        return view("history", ['taskHistories' => $taskHistories]);
    }

    public function getAddCommentForm(int $taskId)
    {
        return view("addingComment", ['taskId' => $taskId]);
    }

    public function addComment(Request $request, int $taskId)
    {
        TaskComment::create([
            'user_id' => Auth::id(),
            'task_id' => $taskId,
            'comment' => $request['comment'],
        ]);
    }

    public function getComments(int $taskId)
    {
        $taskComments = TaskComment::where('task_id', '=', $taskId)->get();

        return view("comments", ['taskComments' => $taskComments]);
    }

    public function editCommentForm(int $commentId)
    {
        $taskComment = TaskComment::where('id', '=', $commentId)->first();

        return view("editingComment", ['taskComment' => $taskComment]);
    }

    public function editComment(Request $request, int $commentId)
    {
        $taskComment = TaskComment::where('id', '=', $commentId)->first();

        $taskComment->update([
            'comment' => $request['comment'],
        ]);
    }

    public function deleteComment(int $commentId)
    {
        $taskComment = TaskComment::where('id', '=', $commentId)->first();
        $taskComment->delete();

        return redirect(url("comments/$taskComment->task_id"));
    }
}
