<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_header')->nullable();
            $table->string('fave_icon')->nullable();
            $table->string('app_name')->nullable();
            $table->string('logo_footer')->nullable();
            $table->string('main_home_image')->nullable();
            $table->string('main_home_title')->nullable();
            $table->string('footer_title1')->nullable();
            $table->string('footer_title2')->nullable();
            $table->text('footer_desc1')->nullable();
            $table->text('footer_desc2')->nullable();

            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('gmail')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();

            $table->double('counter1')->default(0);
            $table->double('counter2')->default(0);
            $table->double('counter3')->default(0);
            $table->double('counter4')->default(0);


            $table->string('counter1_title')->nullable();
            $table->string('counter2_title')->nullable();
            $table->string('counter3_title')->nullable();
            $table->string('counter4_title')->nullable();


            $table->string('video_footer')->nullable();



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
        Schema::dropIfExists('settings');
    }
}
