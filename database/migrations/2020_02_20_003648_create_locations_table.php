<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('postal_code');
            $table->string('street');
            $table->integer('number');
            $table->string('apartment')->nullable();
            $table->string('locality');
            $table->string('province');
            $table->string('province_department');
            $table->bigInteger('user_id');
            $table->text('indications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
