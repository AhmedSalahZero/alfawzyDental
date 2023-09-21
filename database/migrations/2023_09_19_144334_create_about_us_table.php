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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('team_image')->nullable();
            $table->string('title')->nullable();
            $table->text('desc')->nullable();
            $table->string('team_title')->nullable();
            $table->text('team_desc')->nullable();
            $table->string('our_vision_title')->nullable();
            $table->text('our_vision_desc')->nullable();
            $table->string('our_mission_title')->nullable();
            $table->text('our_mission_desc')->nullable();
            $table->string('our_goal_title')->nullable();
            $table->text('our_goal_desc')->nullable();

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
        Schema::dropIfExists('about_us');
    }
};
