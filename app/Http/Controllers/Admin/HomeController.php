<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller {
    // landing page
    public function index() {

        return view('admin.home');

    }
}
