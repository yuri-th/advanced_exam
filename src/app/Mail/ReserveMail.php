<?php

namespace App\Mail;

use App\Models\User; 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReserveMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$shop_name,$reserve_date,$reserve_time,$reserve_number)
    {
        $this->name = $name;
        $this->shop_name = $shop_name;
        $this->reserve_date = $reserve_date;
        $this->reserve_time = $reserve_time;
        $this->reserve_number = $reserve_number;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   // メールアドレスを取得
        $userEmail = User::where('name', $this->name)->value('email');
        
        return $this->to($userEmail) // 送信先アドレス
        ->subject('ご予約ありがとうございます')//件名
        ->view('manage.reserve_mail') //本文
        ->with(['name' => $this->name,'shop_name'=>$this->shop_name,'reserve_date'=>$this->reserve_date,'reserve_time'=>$this->reserve_time,'reserve_number'=>$this->reserve_number]);
    }
}
