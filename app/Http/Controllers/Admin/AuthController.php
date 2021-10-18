<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

    // admin login
    public function login(Request $request) {

        // validate admin info
        $validator = Validator::make($request->all(), [

            'email' => 'required',

            'password' => 'required',

        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator);

        }
// get admin if validation was ok
        $admin = User::where([

            'email' => $request->email,

        ])->first();
// check if this user has access to panel admin

        if ($admin && $admin->hasRole('Admin')) {

            Auth::loginUsingId($admin->id);

            return redirect()->route('admin.dashboard');

        }

        return back()->with(['error' => "You are not an admin."]);

    }
// logout
    public function logout() {

        Auth::logout();

        return redirect()->route('admin.login');

    }
// login panel admin landing page
    public function loginPage() {

        return view('admin.login');

    }

}
