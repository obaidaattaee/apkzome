<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_section', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('section_id');
            $table->unsignedBigInteger('app_id');
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('app_id')->references('id')->on('apps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_section');
    }
}
