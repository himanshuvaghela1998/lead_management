<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index('user_id');
            $table->string('project_title',100);
            $table->integer('project_type_id')->index('project_type_id');
            $table->string('status');
            $table->integer('source_id')->index('source_id');
            $table->string('billing_type');
            $table->string('time_estimation');
            $table->string('cost_estimation')->default(0);
            $table->longText('lead_details')->default('null');
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
        Schema::dropIfExists('leads');
    }
}
