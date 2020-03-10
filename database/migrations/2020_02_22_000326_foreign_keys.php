<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //Schema::table('users', function (Blueprint $table) {
        //    $table->foreign('roles_id')->references('id')->on('roles');
        //});
        //Schema::table('roles', function (Blueprint $table) {
        //    $table->foreign('permissions_id')->references('id')->on('permissions');
        //});
        //Schema::table('products', function (Blueprint $table) {
        //    $table->foreign('category_id')->references('id')->on('categories');
        //    $table->foreign('material_id')->references('id')->on('materials');
        //});
        //Schema::table('categories', function (Blueprint $table) {
        //    $table->foreign('subcategory_id')->references('id')->on('categories');
        //});
        //Schema::table('photos', function (Blueprint $table) {
        //    $table->foreign('products_id')->references('id')->on('products');
        //    $table->foreign('users_id')->references('id')->on('users');
        //});
        //Schema::table('locations_users', function (Blueprint $table) {
        //    $table->foreign('user_id')->references('id')->on('users');
        //    $table->foreign('locations_id')->references('id')->on('locations');
        //});
        //Schema::table('orders', function (Blueprint $table) {
        //    $table->foreign('users_id')->references('id')->on('users');
        //    $table->foreign('status_id')->references('id')->on('status');
        //    $table->foreign('shipping_id')->references('id')->on('shippings');
        //});
        //Schema::table('shippings', function (Blueprint $table) {
        //    $table->foreign('shipping_logs_id')->references('id')->on('shipping_logs');
        //});
        //Schema::table('order_has_products', function (Blueprint $table) {
        //    $table->foreign('orders_id')->references('id')->on('orders');
        //    $table->foreign('products_id')->references('id')->on('products');
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropForeign('roles_id');
        // });
        // Schema::table('roles', function (Blueprint $table) {
        //     $table->dropForeign('permissions_id');
        // });
        // Schema::table('products', function (Blueprint $table) {
        //     $table->dropForeign('category_id');
        //     $table->dropForeign('material_id');
        // });
        // Schema::table('categories', function (Blueprint $table) {
        //     $table->dropForeign('subcategory_id');
        // });
        // Schema::table('photos', function (Blueprint $table) {
        //     $table->dropForeign('products_id');
        //     $table->dropForeign('users_id');
        // });
        // Schema::table('locations_users', function (Blueprint $table) {
        //     $table->dropForeign('user_id');
        //     $table->dropForeign('locations_id');
        // });
    }
}
