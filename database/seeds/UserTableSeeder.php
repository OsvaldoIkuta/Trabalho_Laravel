<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*
        User::created([
            'name'      => 'Osvaldo Ikuta',
            'email'     =>  'osvaldok0000@gmail.com',
            'password'  => bcrypt('secret'),
            'biography' => 'Usuário Fulano de Tal',
        ]);*/

        DB::table('users')->insert([
        'name'      => 'Osvaldo Ikuta',
        'email'     =>  'osvaldok0000@gmail.com',
        'password'  => bcrypt('secret'),
        'biography' => 'Usuário Fulano de Tal',
        ]);

    }
}
