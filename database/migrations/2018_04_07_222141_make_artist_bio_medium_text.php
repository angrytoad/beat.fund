<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeArtistBioMediumText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('artist_bio');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->mediumText('artist_bio')->after('artist_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('artist_bio');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->text('artist_bio')->after('artist_name');
        });
    }
}
