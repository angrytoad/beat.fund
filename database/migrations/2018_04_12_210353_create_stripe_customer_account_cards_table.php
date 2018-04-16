<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeCustomerAccountCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_customer_account_cards', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('stripe_customer_account_id');
            $table->string('card_token');
            $table->string('name');
            $table->string('last4');
            $table->string('brand');
            $table->string('exp_month');
            $table->string('exp_year');
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
        Schema::dropIfExists('stripe_customer_account_cards');
    }
}
