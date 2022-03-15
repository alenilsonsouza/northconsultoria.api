<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    private $subjetc;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subjetc)
    {
        $this->subject = $subjetc;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->subject);
        $this->to('alenilsonsouza@gmail.com','Alenilson Souza');

        return $this->view('');
        
    }
}
