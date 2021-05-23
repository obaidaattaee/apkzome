<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_parts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('part_number');
            $table->string('size')->nullable();
            $table->unsignedBigInteger('app_version_id');
            $table->string('original_link');
            $table->string('extension');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('app_version_id')->references('id')->on('apps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_parts');
    }
}
