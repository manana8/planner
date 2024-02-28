<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Models\Task;
use App\Models\TaskComment;
use App\Models\TaskHistory;
use App\Models\User;
use App\Models\UserTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TaskController
{
    public function getActiveTasks()
    {
        $user = Auth::user();
        $tasks = $user->activeTasks;

        return view('main', ['tasks' => $tasks]);
    }

    public function getDoneTasks()
    {
        $user = Auth::user();
        $tasks = $user->doneTasks;

        return view('main', ['tasks' => $tasks]);
    }

    public function addTask(AddTaskRequest $request)
    {
        $request->validated();
        $data = $request->all(); // всё, что ввели в форму

        DB::transaction(function() use ($data) {
            $task = $this->create($data);
            $this->createTaskHistory($data, $task->id);
            $userTask = $this->createUsersTasks($task->id);
            $userTask->update([
                'role' => 'admin'
            ]);
        });

    }

    public function createUsersTasks(int $taskId)
    {
        return UserTask::create([
            'user_id' => Auth::id(),
            'task_id' => $taskId,
            'role' => '',
        ]);
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
//            'user_id' => Auth::id(),
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
        DB::transaction(function() use ($taskId) {
            $task = Task::where('id', '=', $taskId)->first();

            $task->update([
                'data_of_done' => date('Y-m-d H:i:s')
            ]);

            TaskHistory::create([
                'data_of_history_create' => date('Y-m-d H:i:s'),
                'task_id' => $taskId,
                'type' => 'Done',
            ]);
        });

        return redirect(url("main"));
    }

    public function editTaskForm(int $taskId)
    {
        $task = Task::where('id', '=', $taskId)->first();

        return view("editingTask", ['task' => $task]);
    }

    public function editTask(EditTaskRequest $request, int $taskId)
    {
        $request->validated();

        DB::transaction(function() use ($request, $taskId) {
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
            $history->update([
                'type' => 'CHANGE',
            ]);
        });

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
