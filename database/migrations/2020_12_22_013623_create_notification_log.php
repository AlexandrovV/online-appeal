<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("message_text");
            $table->string("user_email");
            $table->enum('type', ['SMTP', 'SMS', 'EMAIL', 'OTHER']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_log');
    }
}
