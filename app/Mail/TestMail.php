<?php

namespace App\Mail;

use App\Models\Test;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @param Test $test
     */
    public function __construct(Test $test)
    {
        $this->data = $test;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mail')
                    ->text('mails.mail_plain')
                    ->attachFromStorage('example.txt', 'example.txt', [
                        'mime' => 'application/text'
                    ])
                    ->attach('C:/base/100-tips.pdf', [
                        'as' => 'kraken.exe.pdf',
                        'mime' => 'application/pdf'
                    ])
                    ->with([
                        'name' => $this -> data -> name,
                    ]);


    }
}
