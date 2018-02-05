<?php

use Faker\Generator as Faker;

$factory->define(App\Score::class, function (Faker $faker) {
    return [
        'vote'=>$faker->numberBetween($min= 1, $max= 5),
        'IP'=>$faker->ipv4,
        'book_id'=>rand(1,30)
    ];
});
