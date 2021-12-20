<?php

namespace App\Repositories\Task;

use App\Models\Task;

class TaskRepository extends \App\Repositories\BaseRepository
{


    protected $model;


    public function __construct(Task $model)
    {
        $this->model = $model;
    }
    public function updateStatus(int $id)
    {
        $task =  $this->findById($id) ;
        if ($task) {
            $task->status ? $task->status = false : $task->status = true;
            $task->save();
            return $task->status ;
        }
        return false ;
    }

    public function checkUserAlreadyHasTaskOnThatDate(User $user , $date)
    {
        $task = $user->tasks()->where('reserved_at', $date)->first();
        return $task  ;
    }

}
