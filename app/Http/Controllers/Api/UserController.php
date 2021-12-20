<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\Api\LoginResource;
use App\Http\Resources\Api\UserAuthResource;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    private $userRepository ;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository ;
    }
    // get user controller
    public function user(Request $request) {
        return response()->json($request->user());
    }
// login controller
    public function login(LoginRequest $request) {
        $user_login_info = $this->userRepository->Login($request->email , $request->password) ;
        if (!$user_login_info['result']) return new LoginResource(['data'=> '' , 'status_code' => 401 , 'errors' => ['user' => $user_login_info['message']] ]) ;

        $user = $user_login_info['user'] ;
//        create token for user
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return new UserAuthResource(['access_token' =>  $tokenResult->accessToken , 'message' =>  'You have loged in successfully.' , 'user' => $user ]) ;

    }
    // register controller
    public function register(RegisterRequest $request) {

        $request->request->add(['password' => Hash::make($request->password) ] );
        $user = $this->userRepository->create($request->validated()) ;

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return new UserAuthResource(['access_token' =>  $tokenResult->accessToken , 'message' =>  'You have registered in successfully.' , 'user' => $user ]) ;

    }
}
