<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('shipping_info');
            $table->text('billing_info');
            $table->text('product_list');
            $table->text('mercadopago_info')->nullable();
            $table->string('preorder_id', 10);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('shipping_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
