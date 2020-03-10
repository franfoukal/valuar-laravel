<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'path' => $faker->randomElement(['/img/products/prod-1.png', '/img/products/prod-2.png', '/img/products/prod-3.png', '/img/products/prod-4.png']),
        'active' => $faker->numberBetween(0,1),
        'product_id' => $faker->numberBetween(1,400)
    ];
});
