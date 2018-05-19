<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('ticket_store_id');
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->mediumText('description_delta')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('price')->nullable();
            $table->boolean('live');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('location');
            $table->string('banner_key')->nullable();
            $table->string('banner_url')->nullable();
            $table->string('background_color');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
