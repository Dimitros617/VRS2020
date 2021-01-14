<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permition')->insert([
            'id' => 1,
            'name' => 'Registrovaný',
            'possibility_renting' => 0,
            'new_user' => 0,
            'return_verification' => 0,
            'edit_item' => 0,
            'edit_permitions' => 0,
        ]);
        DB::table('permition')->insert([
            'id' => 2,
            'name' => 'Ověřený',
            'possibility_renting' => 1,
            'new_user' => 0,
            'return_verification' => 0,
            'edit_item' => 0,
            'edit_permitions' => 0,

        ]);
        DB::table('permition')->insert([
            'id' => 3,
            'name' => 'Administrátor',
            'possibility_renting' => 1,
            'new_user' => 1,
            'return_verification' => 1,
            'edit_item' => 1,
            'edit_permitions' => 1,

        ]);
    }
}
