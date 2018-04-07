<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoreSlugColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('slug');
        });

        foreach (\App\Models\Store::all() as $store){
            if($store->slug === ''){
                $profile = $store->user->profile;
                if($profile){
                    $count = \App\Models\Store::where('slug',str_slug($profile->artist_name,'-'))->count();
                    if($count > 0){
                        $slug = str_slug($profile->artist_name.'-'.$count,'-');
                    }else{
                        $slug = str_slug($profile->artist_name,'-');
                    }

                    $store->slug = $slug;
                    $store->save();
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
