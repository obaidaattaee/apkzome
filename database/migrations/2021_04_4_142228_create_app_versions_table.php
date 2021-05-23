<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_versions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('version_number');
            $table->string('size')->nullable();
            $table->dateTime('published_at');
            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('os_version_id');
            $table->string('signature');
            $table->string('screen_dpi');
            $table->string('architecture');
            $table->string('file_hash');
            $table->string('original_link');
            $table->string('extension');
            $table->integer('sort_number')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('apps');
            $table->foreign('os_version_id')->references('id')->on('o_s_versions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_versions');
    }
}
