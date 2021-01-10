<?php


namespace App\Mail;


use App\Models\Appeal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProtocolMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @param Appeal $appeal
     */
    public function __construct(Appeal $appeal)
    {
        $this->data = $appeal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.appeal_accepted')
            ->attach(public_path() . '/protocol-'. $this->data->id . '.pdf', [
                'as' => 'Протокол-.pdf',
                'mime' => 'application/pdf'
            ])
            ->with([
                'id' => $this -> data -> id
            ]);


    }
}
