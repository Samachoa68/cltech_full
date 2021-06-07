<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_slider', function (Blueprint $table) {
            $table->increments('slider_id');
            $table->string('slider_name',255);
            $table->string('slider_image',100);
            $table->integer('slider_status');
            $table->integer('slider_stt');
            $table->string('slider_desc',100);
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
        Schema::dropIfExists('tbl_slider');
    }
}
