<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
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
            'name' => 'ゲストユーザー',
            'email' => 'guest@example.com',
            'password' => Hash::make('guest00pass')
        ]);
    }
}
