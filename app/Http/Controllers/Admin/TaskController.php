<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {

    // get tasks in panel amdin
    public function index() {

        $tasks = Task::filter()->latest()->get();

        return view('admin.task.all', compact('tasks'));

    }
    // update task status
    public function updateStatus(Request $request) {

        $task = Task::find($request->id);
        $task->status ? $task->status = false : $task->status = true;
        $task->save();

        return response()->json($task->status);
    }
}
