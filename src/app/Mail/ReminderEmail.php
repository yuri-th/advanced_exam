<?php

namespace App\Mail;

use App\Models\Reservation; 
use App\Models\User; 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderEmail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $reservation)
    {   
        $this->user = $user;
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this
            ->to($this->user->email)
            ->subject('ご予約ありがとうございます')
            ->view('manage.reminder', ['user' => $this->user, 'reservation' => $this->reservation]);
    }
}
