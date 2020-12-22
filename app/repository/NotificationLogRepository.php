<?php


namespace App\repository;


use App\Models\NotificationLog;
use Illuminate\Support\Facades\Log;

class NotificationLogRepository
{
    public function save($message_text, $user_email, $type) {
        $log = new NotificationLog();
        $log -> message_text = $message_text;
        $log -> user_email = $user_email;
        $log -> type = $type;
        $log->save();
        Log::info("Notification added:\n", ['message_text' => $log -> message_text, 'user_email' => $log -> user_email]);
    }

    public function findAll() {
        return NotificationLog::all();
    }
}
