<?php

namespace App\Http\Controllers\auth;

use Afsakar\FilamentOtpLogin\Models\OtpCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class otpAdminController extends Controller
{
    public static string $email;

    public function show() {
        return view('vendor/filament-otp-login/pages/login');
    }

    public function prefill() {
        OtpCode::where('email', self::$email);
    }
}
