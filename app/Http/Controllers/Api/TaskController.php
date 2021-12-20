<?php

namespace App\Http\Controllers\Api;

use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\ChangeDateRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\Api\GetEmployeesResource;
use App\Http\Resources\Api\SubmitTaskResource;
use App\Models\User;
use App\Repositories\Task\TaskRepository;
use App\Repositories\User\UserRepository;
use App\Services\Task\TaskService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TaskController extends Controller
{


    private $taskService;
    private $taskRepository;
    private $userRepository;

    public function __construct(
        TaskService    $taskService,
        TaskRepository $taskRepository,
        UserRepository $userRepository

    )
    {
        $this->userRepository = $userRepository;
        $this->taskService = $taskService;
        $this->taskRepository = $taskRepository;

    }

    // change date and get available tasks based on date
    public function changeDate(ChangeDateRequest $request)
    {
        $user = $request->user();
        // get week days
        $weekdays = $this->taskService->getWeekDays($request->date);
        // get tasks

        if ($user->hasRole('Admin'))         // admin can see all user's tasks
            $tasks = $this->taskService->allTaskToShowToAdmin($request->date);
        else // user just can see hes own tasks
            $tasks = $this->taskService->allTaskToShowToAdmin($user, $request->date);

        return response()->json(['weekdays' => $weekdays, 'tasks' => $tasks]);

    }

// submiting task and waiting for admin to confirm
    public function submitTask(TaskRequest $request)
    {
        $user = $request->user();
        $task = $this->taskRepository->checkUserAlreadyHasTaskOnThatDate($user, $request->date);
        if ($task) return new SubmitTaskResource(['status_code' => 406, 'data' => '', 'errors' => ["task" => ["this date is already reserved"],]]);

        $task = $this->taskRepository->create($request->validated());

        return new SubmitTaskResource(['status_code' => 406, 'data' => $task, 'errors' => [],]);

    }

// get employees api
    public function getEmployees(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('Admin')) $users = $this->userRepository->all();
         else $users = [$user];
        return new GetEmployeesResource(['data' => $users , 'status_code' => 200 ]);
    }
}
