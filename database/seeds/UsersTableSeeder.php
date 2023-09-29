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
        //
        DB::table('users')->insert([
            'username' => 'Atlas一郎',
            'mail' => 'tropius09@gmail.com',
            'password' => bcrypt('0000'),
        ]);
    }
}
