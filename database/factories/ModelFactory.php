<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Item::class, function (Faker\Generator $faker) {
    return [
        'artno' => strtoupper(str_random(6)),
        'description' => $faker->sentence,
        'price' => $faker->randomNumber(6),
    ];
});
