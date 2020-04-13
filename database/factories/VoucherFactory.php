<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Voucher;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Voucher::class, function (Faker $faker) {

    $voucher =  [
        'code' => Str::random(10),
        'valid_since' => $faker->dateTimeBetween('now', strtotime("now")),
        'valid_to' => $faker->dateTimeBetween('now', strtotime('+30 days')),
        'type' => $faker->randomElement(['voucher', 'discount']),
    ];

    if($voucher['type'] == 'voucher'){
        $voucher['value'] = $faker->numberBetween(100, 2000); 
    } else{
        $voucher['value'] = $faker->randomFloat(2,0,1);
    }
    return $voucher;
});
