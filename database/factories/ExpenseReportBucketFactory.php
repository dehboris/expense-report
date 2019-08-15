<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ExpenseReport\Bucket;
use Faker\Generator as Faker;

$factory->define(Bucket::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(\App\User::class)->create()->id;
        },
        'name' => $faker->words(rand(1, 5), true),
        'description' => $faker->sentence,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
