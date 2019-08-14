<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ExpenseReport\Bucket;
use Faker\Generator as Faker;

$factory->define(Bucket::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create(),
        'name' => $faker->words(rand(1, 5), true),
        'description' => $faker->sentence,
    ];
});
