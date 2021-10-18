<?php
namespace App\Http\Controllers\Api;

use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\TaskRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TaskController extends Controller {

    // change date and get available tasks based on date
    public function changeDate(Request $request) {
        $user = $request->user();
        $date = $request->date;
        $carbon = Carbon::parse($date);

        $weekStartDate = $carbon->startOfWeek()->format('Y-m-d');
        $weekEndDate = $carbon->endofWeek()->format('Y-m-d');

        // get week days
        $weekdays = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $carbon->startOfWeek()->addDays($i);
            $date = ['date' => $date->format('Y-m-d'), 'name' => $date->format('l')];
            array_push($weekdays, $date);
        }
// get tasks
        $tasks = [];

        // admin can see all user's tasks
        if ($user->hasRole('Admin')) {
            $users = User::all();

            foreach ($users as $user) {
                for ($i = 0; $i < 7; $i++) {
                    $date = $carbon->startOfWeek()->addDays($i);
                    $user_task = $user->tasks()->where('status', 1)->where('reserved_at', $date)->first();
                    if (!$user_task) {
                        $user_task = (object) array('empty' => true, 'date' => $date->format('Y-m-d'));
                    }

                    $tasks[] = $user_task;
                }
            }

        } else {
            // user just can see hes own tasks
            $users = [$request->user()];

            $user = $request->user();
            for ($i = 0; $i < 7; $i++) {
                $date = $carbon->startOfWeek()->addDays($i);
                $user_task = $user->tasks()->where('status', 1)->where('reserved_at', $date)->first();
                if (!$user_task) {
                    $user_task = (object) array('empty' => true, 'date' => $date->format('Y-m-d'));
                }

                $tasks[] = $user_task;
            }
        }

        return response()->json(['weekdays' => $weekdays, 'tasks' => $tasks]);

    }
// submiting task and waiting for admin to confirm
    public function submitTask(TaskRequest $request) {
        $user = $request->user();
        $date = $request->date;
        $task = $user->tasks()->where('reserved_at', $date)->first();
        if ($task) {
            return response()->json([
                "message" => "The given data was invalid.",
                "errors" => [
                    "task" => ["this date is already reserved"],
                ],
            ], 422);
        }

        $user->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'reserved_at' => $request->date,
        ]);
        // call event for push notification in admin panel
        event(new MyEvent('New task has been recieved.'));

        return response()->json([

            'message' => 'Task added successfully.now you should wait for Admin to confirm  .',
        ]);

    }
// get users api
    public function getEmployees(Request $request) {
        $user = $request->user();

        if ($user->hasRole('Admin')) {
            $users = User::all();

        } else {
            $users = [$user];
        }
        return response()->json($users);
    }
}
