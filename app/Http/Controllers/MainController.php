<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class MainController extends BaseController
{
    public function getMainPage()
    {
        $userId = Auth::id();
        $tasks = Task::with('category')->get()->where('user_id', $userId)->sortByDesc('deadline');

        return view('main', ['tasks' => $tasks]);
    }

}
