<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller {
// get users
    public function index() {

        $users = User::latest()->get();

        return view('admin.user.all', compact('users'));

    }

}
