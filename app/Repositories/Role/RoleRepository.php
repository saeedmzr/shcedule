<?php

namespace App\Repositories\Role;

use App\Models\Role;

class RoleRepository extends \App\Repositories\BaseRepository
{


    public function __construct(Role $model)
    {
        $this->model = $model;
    }

}
