<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Dlouhodobý hmotný majetek'],
            ['id' => 2, 'name' => 'Dlouhodobý nehmotný majetek'],
            ['id' => 3, 'name' => 'Drobný majetek'],
        ]);
    }
}
