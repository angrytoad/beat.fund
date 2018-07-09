<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('ticket_id');
            $table->uuid('user_id')->nullable();
            $table->string('email')->index();
            $table->string('full_name');
            $table->integer('quantity');
            $table->integer('price_per_ticket');
            $table->integer('total_paid');
            $table->uuid('seed')->index();
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
        Schema::dropIfExists('ticket_orders');
    }
}
