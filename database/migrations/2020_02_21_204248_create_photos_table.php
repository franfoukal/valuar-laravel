<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('path',200)->unique();
            $table->string('extension',200)->nullable();
            $table->int('active');
            $table->unsignedBigInteger('products_id')->nullable();
            $table->foreign('products_id')->references('products')->on('id');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('users')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
