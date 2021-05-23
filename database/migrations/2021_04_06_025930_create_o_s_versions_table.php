<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOSVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_s_versions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('os_type_id');
            $table->string('version');
            $table->softDeletes();
            $table->timestamps();

//            $table->foreign('os_type_id')->references('id')->on('o_s_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('o_s_versions');
    }
}
