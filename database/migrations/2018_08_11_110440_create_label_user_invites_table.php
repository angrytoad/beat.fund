<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelUserInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_user_invites', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('label_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->index();
            $table->string('role');
            $table->uuid('invite_code');
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
        Schema::dropIfExists('label_user_invites');
    }
}
