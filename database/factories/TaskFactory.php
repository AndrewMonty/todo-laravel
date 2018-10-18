<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'completed_at' => $faker->dateTimeThisMonth
    ];
});
