<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->firstName,
        'price' => $faker->numberBetween(1000,5000),
        'barcode' => $faker->unique()->ean13,
        'has_size' => $faker->numberBetween(0,1),
        'description' => $faker->text(100),
        'stock' => $faker->numberBetween(0,200),
        'active' => $faker->numberBetween(0, 1),
        'category_id' =>  $faker->numberBetween(1, 20),
        'material_id' =>  $faker->numberBetween(1, 2),
        'amount_sold' => $faker->numberBetween(0,200)
    ];
});
