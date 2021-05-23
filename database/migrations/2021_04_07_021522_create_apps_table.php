<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->string('extension');
            $table->bigInteger('download_counter')->default(1);
            $table->date('published_at');
            $table->string('image');
            $table->boolean('on_server');
            $table->integer('rate');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('os_type_id');
            $table->unsignedBigInteger('os_version_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
//            $table->foreign('owner_id')->references('id')->on('vendors');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('os_type_id')->references('id')->on('o_s_types');
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
        Schema::dropIfExists('apps');
    }
}
