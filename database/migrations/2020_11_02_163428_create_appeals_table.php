<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appeals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('text');
            $table->enum('status',['created','cancelled', 'waiting', 'on_review', 'accepted']);
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('student_id');
            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects');
            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers');
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->foreign('student_id')
                ->references('id')
                ->on('users');
            $table->bigInteger('verifier_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appeals');
    }
}
