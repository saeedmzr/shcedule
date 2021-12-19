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

}
