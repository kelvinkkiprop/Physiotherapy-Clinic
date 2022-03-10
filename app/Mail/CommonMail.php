<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommonMail extends Mailable
{
    use Queueable, SerializesModels;

    //Declare public variable
    public $data;

    /**
     * Create a new message instance.
    *
    * @return void
    */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
    *
    * @return $this
    */
    public function build()
    {
        if($this->data['file']){
            return $this->view('others.email')
            ->subject($this->data['subject'])
            ->with('data', $this->data)
            ->attachData($this->data['file'], $this->data['file_name']);
        }else{
            return $this->view('others.email')
            ->subject($this->data['subject'])
            ->with('data', $this->data);

        }
    }
}
