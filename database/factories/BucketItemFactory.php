<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ExpenseReport\BucketItem;
use Faker\Generator as Faker;

$factory->define(BucketItem::class, function (Faker $faker) {
    return [
        'bucket_id' => function() {
            return factory(\App\ExpenseReport\Bucket::class)->create()->id;
        },
        'name' => $faker->words(rand(3, 20), true),
        'type' => \Illuminate\Support\Arr::random([BucketItem::CREDIT, BucketItem::DEBIT]),
        'amount' => rand(10, 1000000),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
