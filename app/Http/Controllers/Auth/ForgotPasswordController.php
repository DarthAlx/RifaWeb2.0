<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Tu enlace de recuperación de contraseña.';
    }
   public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('xxxYou are receiving this email because we received a password reset request for your account.')
            ->action('xxxReset Password', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('xxxIf you did not request a password reset, no further action is required.');
    }
}
