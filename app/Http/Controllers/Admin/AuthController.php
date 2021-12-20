<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Resources\Admin\LoginResource;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    // admin login
    public function login(LoginRequest $request)
    {
        $admin_login = $this->userRepository->LoginAdminByEmail($request->email, $request->password);
        if ($admin_login['result'] == true)
        {
            Auth::loginUsingId($admin_login['admin']->id);
            return redirect()->route('admin.dashboard') ;
        }
        return back()->withErrors(['message' =>  $admin_login['message'] ]) ;
    }

// logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
// login panel admin landing page
    public function loginPage()
    {
        return view('admin.login');
    }
}
