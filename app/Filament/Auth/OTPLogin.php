<?php


namespace App\Filament\Auth;

use Afsakar\FilamentOtpLogin\Filament\Pages\Login as BaseOTPLogin;
use Afsakar\FilamentOtpLogin\Models\OtpCode;
use Afsakar\FilamentOtpLogin\Notifications\SendOtpCode;
use Filament\Http\Responses\Auth\LoginResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as BaseAuth;
 
class OTPLogin extends BaseOTPLogin
{

    public function authenticate(): ?LoginResponse
    {
        $this->rateLimiter();

        $this->verifyCode();

        $this->doLogin();

        return app(LoginResponse::class);
    }

    protected function sendOtpToUser(string $otpCode): void
    {
        $this->email = $this->data['email'];

        $this->notify(new SendOtpCode($otpCode));

        $code = OtpCode::where('email', $this->data['email'])->first();

        Notification::make()
            ->title('OTP CODE')
            ->body($code->code)
            ->success()
            ->send();
    }
}