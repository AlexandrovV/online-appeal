<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('data');
            $table->enum('status', ['created','send','cancelled','error']);
            $table->unsignedBigInteger('document_template_id');
            $table->foreign('document_template_id')
                ->references('id')
                ->on('document_templates')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_logs');
    }
}
