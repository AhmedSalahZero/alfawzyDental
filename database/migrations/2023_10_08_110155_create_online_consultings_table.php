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
        Schema::create('online_consultings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('complaint')->nullable();
            $table->string('front_teeth_image')->nullable();
            $table->string('side_teeth_image')->nullable();
            $table->string('upper_teeth_image')->nullable();
            $table->string('lower_teeth_image')->nullable();
            $table->string('x_ray')->nullable();
            $table->string('passport_or_id')->nullable();
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
        Schema::dropIfExists('online_consultings');
    }
};
