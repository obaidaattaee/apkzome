<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->json('title');
            $table->text('description');
            $table->string('icon');
            $table->boolean('is_active')->default(true);
            $table->boolean('can_delete')->default(true);
            $table->unsignedInteger('parent_category')->nullable();
            $table->unsignedBigInteger('created_by')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_category')->references('id')->on('categories');
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
        Schema::dropIfExists('categories');
    }
}
