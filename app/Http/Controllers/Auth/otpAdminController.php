<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class otpAdminController extends Controller
{
    public function show() {
        return view('vendor/filament-otp-login/pages/login');
    }
}
