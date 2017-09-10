<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignedTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signed_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->text('steam_ticket');
            $table->string('signed_ticket', 128);
            $table->bigInteger('service_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signed_tickets');
    }
}
