<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_threads', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id')->index('lead_id');
            $table->integer('sender_id')->nullable();
            $table->integer('recipient_id')->nullable();
            $table->longText('message')->nullable();
            $table->tinyInteger('is_attachment')->default(0);
            $table->longText('attachment_url')->nullable();
            $table->string('attachment_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_threads');
    }
}
