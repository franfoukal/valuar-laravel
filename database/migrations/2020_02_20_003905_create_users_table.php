<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name', 45);
            $table->string('surname', 45);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('phone')->nullable();
            $table->tinyInteger('active')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->unsignedBigInteger('roles_id');
            // $table->foreign('roles_id')->references('roles')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
