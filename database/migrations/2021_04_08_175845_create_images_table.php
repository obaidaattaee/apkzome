<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->json('image_title');
            $table->json('image_alt');
            $table->boolean('on_server');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('app_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('apps');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
