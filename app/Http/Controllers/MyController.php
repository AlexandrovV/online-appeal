<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Test;
use Illuminate\Support\Facades\Mail;

class MyController extends Controller
{
    public function basic_email() {
        $data = array('name'=>"Mahab Mahab mahab");

        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('deathhunter222@gmail.com', 'Tutorials Point')
                ->subject('Laravel Basic Testing Mail');
            $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "Basic Email Sent. Check your inbox.";
    }

    public function html_email() {
        $data = array('name'=>"Allakh");
        Mail::send('mail', $data, function($message) {
            $message->to('deathhunter222@gmail.com', 'Tutorials Point')
                ->subject('Laravel HTML Testing Mail');
            $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
    }
    public function attachment_email() {
        $test = new Test();
        $test->name = 'NAME';
        $test->my_enum = 'a';
        $test->my_int = 2;
        foreach (['deathhunter222@gmail.com'] as $recipient) {
            Mail::to($recipient)->send(new TestMail($test));
        }

        echo "Email Sent with attachment. Check your inbox.";
    }
}
