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
        $user->name = 'Editor';
        $user->email = 'editor@editor.com';
        $user->password = bcrypt('editor');
        $user->save();

    }
}
