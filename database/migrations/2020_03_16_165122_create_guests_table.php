<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('amgros_employee')->nullable();
            $table->date('created_at')->nullable(true);
            $table->date('updated_at')->nullable(true)->default(null);
            $table->date('departed_at')->nullable(true)->default(null);
            $table->time('time_created')->nullable();
            $table->time('time_updated')->nullable();
            $table->time('time_departed')->nullable();
            $table->integer('status')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
