<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->uuid('administrator_id');
            $table->string('company_number');
            $table->string('company_name');
            $table->string('company_address_first_line');
            $table->string('company_address_second_line')->nullable();
            $table->string('company_address_postcode');
            $table->string('company_address_city');
            $table->string('company_address_county');
            $table->string('company_address_country');
            $table->string('company_telephone_number')->nullable();
            $table->string('company_email_address')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('labels');
    }
}
