<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name', 100)->unique();
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('barcode')->nullable()->unique();
            $table->int('has_size')->nullable();
            $table->string('description', 200)->nullable();
            $table->unsignedBigInteger('stock')->nullable();
            $table->int('rating')->nullable();
            $table->unsignedBigInteger('amount_sold')->nullable();
            $table->int('active')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('categories')->on('id');
            $table->unsignedBigInteger('materials_id')->nullable();
            $table->foreign('materials_id')->references('materials')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
