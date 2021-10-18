<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

    // landing page
    public function index() {

        return view('web.landing');

    }
}
