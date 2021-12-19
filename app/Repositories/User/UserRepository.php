<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    protected $model;


    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function LoginAdminByEmail(string  $email , string $password)
    {
        $admin = $this->model->where('email', $email)->first();
        if (!$admin ) return ['result' => false , 'message' => 'wrong admin information.' , 'status_code' => 404]  ;

        if (!Hash::check($admin->password , $password)) return ['result' => false , 'message' => 'wrong admin information.' , 'status_code' => 401]  ;

        return ['admin'=> $admin , 'result'=> true , 'message' => 'this use is admin .' , 'status_code' => 200] ;

    }

}
