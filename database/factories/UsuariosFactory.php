<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Usuarios::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10))
    ];
});
