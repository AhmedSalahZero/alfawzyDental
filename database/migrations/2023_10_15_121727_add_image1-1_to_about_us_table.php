<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us', function (Blueprint $table) {
            //
            $table->string('image1-1')->nullable()->after('id');
            $table->string('image1-2')->nullable()->after('id');
            $table->string('image1-3')->nullable()->after('id');

            $table->string('our_mission_title_home')->nullable()->after('id');
            $table->text('our_mission_desc_home')->nullable()->after('id');
            $table->string('our_goal_title_home')->nullable()->after('id');
            $table->text('our_goal_desc_home')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_us', function (Blueprint $table) {
            //
        });
    }
};
