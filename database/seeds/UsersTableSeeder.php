<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'Raphael Cunha',
            'email' => 'rbcunhadesign@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Qwerty123'),
        ]);
    }
}
