<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\ResiduoClasses::class, function (Faker $faker) {
    return [
        'descricao' => $faker->name
    ];
});
