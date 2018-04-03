<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerAndAvatarColumnsStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('banner_key')->nullable();
            $table->string('banner_url')->nullable();
            $table->string('avatar_key')->nullable();
            $table->string('avatar_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_line_items', function (Blueprint $table) {
            $table->dropColumn('banner_key');
            $table->dropColumn('banner_url');
            $table->dropColumn('avatar_key');
            $table->dropColumn('avatar_url');
        });
    }
}
