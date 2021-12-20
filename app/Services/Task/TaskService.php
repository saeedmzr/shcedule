<?php

namespace App\Services\Task;

use App\Models\User;
use App\Repositories\Task\TaskRepository;
use Carbon\Carbon;

class TaskService implements \App\Services\BaseServiceInterface
{
    private $taskRepository ;

    public function __construct(TaskRepository  $taskRepository)
    {
        $this->taskRepository = $taskRepository ;
    }

    public function getWeekDays (string $date )
    {
        $date_input = Carbon::parse($date);

        // get week days
        $weekdays = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $date_input->startOfWeek()->addDays($i);
            $date = ['date' => $date->format('Y-m-d'), 'name' => $date->format('l')];
            array_push($weekdays, $date);
        }

        return $weekdays ;
    }

    public function allTaskToShowToAdmin(string $date)
    {
        $date_input = Carbon::parse($date);
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 7; $i++) {
                $date = $date_input->startOfWeek()->addDays($i);
                $user_task = $user->tasks()->where('status', 1)->where('reserved_at', $date)->first();
                if (!$user_task) {
                    $user_task = (object) array('empty' => true, 'date' => $date->format('Y-m-d'));
                }

                $tasks[] = $user_task;
            }
        }

        return $tasks ;
    }
    public function userWeekdaysTasks(User $user , string $date)
    {
        $date_input = Carbon::parse($date);

        for ($i = 0; $i < 7; $i++) {
            $date = $date_input->startOfWeek()->addDays($i);
            $user_task = $user->tasks()->where('status', 1)->where('reserved_at', $date)->first();
            if (!$user_task) {
                $user_task = (object) array('empty' => true, 'date' => $date->format('Y-m-d'));
            }

            $tasks[] = $user_task;
        }

        return $tasks ;
    }

    public function submitTask()
    {

    }

}
