<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_videos', function (Blueprint $table) {
            $table->increments('video_id');
            $table->string('video_title');
            $table->string('video_slug');
            $table->string('video_link');
            $table->string('video_desc');
            $table->string('video_image');
            $table->integer('video_status');
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
        Schema::dropIfExists('tbl_videos');
    }
}
