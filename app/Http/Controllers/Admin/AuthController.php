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
        if ($admin_login['result'] == true) Auth::loginUsingId($admin['admin']);
        return new LoginResource(['message' => $admin_login['message'], 'status_code' => $admin_login['status_code']]);

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
