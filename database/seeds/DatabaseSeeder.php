<?php

use App\ExpenseReport\Bucket;
use App\ExpenseReport\BucketItem;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);

        factory(User::class, 1000)->create()->each(function($user) {
            factory(Bucket::class, rand(3, 5))->make(['user_id' => $user->id])->each(function($bucket) use ($user) {
                $user->buckets()->save($bucket);
                factory(BucketItem::class, rand(50, 100))->make(['bucket_id' => $bucket->id])->each(function($item) use ($bucket) {
                    $bucket->items()->save($item);
                });
            });
        });
    }
}
