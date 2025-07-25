<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }


    public function build()
    {
        return $this->view('emails.otp') // Create this Blade view
            ->subject('Your OTP Code')
            ->with(['otp' => $this->otp]);
    }
}
