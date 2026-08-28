<?php

namespace CollegeAdmin\Http\Controllers\Auth;

use CollegeAdmin\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(){
        return view('college-admin::admin.auth.register');
    }
}
