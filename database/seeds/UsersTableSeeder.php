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
        User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@dis.dev',
            'admin' => 1,
            'avatar' => asset('avatars/avatar.png')
        ]);

        User::create([
            'name' => 'Manoj',
            'password' => bcrypt('manoj'),
            'email' => 'manoj@gmail.com',
            'avatar' => asset('avatars/avatar.png')
        ]);
    }
}
