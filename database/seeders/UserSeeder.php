<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'email'      => 'a@gmail.com',
            'password'   => Hash::make('12345'),
            'role'       => UserRole::ADMIN,
            'first_name' => fake()->name(),
            'last_name'  => fake()->name(),

        ]);
    }
}
