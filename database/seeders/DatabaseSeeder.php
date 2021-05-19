<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $dummyUser = new User([
             'name' => 'Arthur Dent',
             'email' => 'arthur.dent@galaxy.com',
             'email_verified_at' => now(),
             'password' => Hash::make('password')
         ]);
         $dummyUser->save();

        \App\Models\User::factory(9)->create();
    }
}
