<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Repositories\Task\TaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller {

    private $taskRepository ;
    public function __construct(TaskRepository  $taskRepository)
    {
        $this->taskRepository = $taskRepository ;
    }

    // get tasks in panel amdin
    public function index() {

        $tasks = $this->taskRepository->all() ;
        return view('admin.task.all', compact('tasks'));

    }
    // update task status
    public function updateStatus(Request $request) {

        $task = $this->taskRepository->updateIfTaskFoundById($request->id) ;

        return response()->json($task);
    }
}
