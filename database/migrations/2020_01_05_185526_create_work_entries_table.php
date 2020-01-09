<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('client_id');
            $table->bigInteger('project_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('work_type');
            $table->text('description');
            $table->bigInteger('work_time');
            $table->string('billable');
            $table->string('billed')->default('No');
            $table->string('client_url_id');
            $table->string('project_url_id');
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
        Schema::dropIfExists('time_keepings');
    }
}
