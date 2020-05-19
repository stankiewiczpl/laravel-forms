<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->nullableMorphs('model_images');
            $table->nestedSet();
            $table->string('directory');
            $table->string('filename');
            $table->string('extension');
            $table->string('title')->nullable();
            $table->string('flag')->nullable();
            $table->string('collection')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_images');
    }
}
