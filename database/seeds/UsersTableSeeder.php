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
        $user = new User;
        $user->name = 'Nico';
        $user->email = 'nicolas0506@gmail.com';
        $user->password = bcrypt('calamaro');
        $user->save();

        $user = new User;
        $user->name = 'Jorge Sanchez';
        $user->email = 'jsanchez@avantio.com';
        $user->password = bcrypt('avantio');
        $user->save();
    }
}
