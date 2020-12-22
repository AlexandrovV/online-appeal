<?php


namespace App\Mail;


use App\Models\Appeal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppealMail extends Mailable
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
        return $this->view('mails.appeal_success')
                    ->attach(public_path() . '/appeal-'. $this->data->id . '.pdf', [
                        'as' => 'Аппеляция-.pdf',
                        'mime' => 'application/pdf'
                    ])
                    ->with([
                        'name' => $this -> data -> student -> name,
                        'id' => $this -> data -> id
                    ]);


    }


}
