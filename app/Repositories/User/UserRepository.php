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

    public function  Login (string  $email , string $password)
    {

        $user = $this->model->where('email', $email)->first();

        if (!$user ) return ['result' => false , 'message' => 'wrong  information.' ]  ;

        if (!Hash::check( $password  ,$user->password )   ) return ['result' => false , 'message' => 'wrong  information.' ]  ;

        return ['user'=> $user , 'result'=> true , 'message' => 'successfull' ] ;

    }

    public function LoginAdminByEmail(string  $email , string $password)
    {
        $admin_login_response = $this->Login($email , $password) ;
        if (!$admin_login_response['result']) return $admin_login_response ;

        if ( !  $admin_login_response['user']->hasRole('Admin'))  return ['result' => false , 'message' => 'you are not an admin.' ]  ;

        return ['admin'=> $admin_login_response['user'] , 'result'=> true , 'message' => 'this use is admin .' ] ;

    }

}
