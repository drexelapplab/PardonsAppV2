<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'PLSE Admin',
            'email' => 'admin@plse.org',
            'password' => bcrypt('pArd0nm3!')
        ]);

        //admin id = 2
        $user->roles()->attach(2);
    }
}
