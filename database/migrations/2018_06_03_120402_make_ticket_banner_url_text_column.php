<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeTicketBannerUrlTextColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('banner_url');
            $table->dropColumn('banner_key');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->text('banner_key')->nullable()->after('location');
            $table->text('banner_url')->nullable()->after('banner_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('banner_url');
            $table->dropColumn('banner_key');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->string('banner_key')->nullable()->after('location');
            $table->string('banner_url')->nullable()->after('banner_key');
        });
    }
}
