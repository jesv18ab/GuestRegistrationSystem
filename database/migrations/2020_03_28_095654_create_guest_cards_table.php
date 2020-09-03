<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_cards', function (Blueprint $table) {
            $table->id("id");
            $table->unsignedBigInteger('guestId')->nullable();
            $table->unsignedBigInteger('status')->default(1)->nullable(false);
            $table->timestamps();
            $table-> foreign('guestId')
                ->references('id')->
                on('guests')->
                onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_cards');
    }
}
