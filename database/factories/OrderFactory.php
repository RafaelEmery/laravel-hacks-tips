<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(['delivered', 'pending', 'cancel']),
        'paid' => $faker->boolean(50),
        'track_code' => $faker->md5(uniqid(rand(), true))
    ];
});
