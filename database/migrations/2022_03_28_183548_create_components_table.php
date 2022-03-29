<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->string('view_path');
            $table->string('edit_path');
            $table->string('status');
            $table->string('needed_action');
            $table->string('assigned_to')->nullable();
            $table->text('notes')->nullable();
            $table->json('experience_fragment_path')->nullable();
            $table->string('team_site')->nullable();
            $table->string('team')->nullable();
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
        Schema::dropIfExists('components');
    }
}
