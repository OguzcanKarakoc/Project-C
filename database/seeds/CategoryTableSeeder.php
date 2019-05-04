<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Non-game',
        ]);
        DB::table('categories')->insert([
            'name' => 'Adventure',
        ]);
        DB::table('categories')->insert([
            'name' => 'Casual',
        ]);
        DB::table('categories')->insert([
            'name' => 'Free',
        ]);
        DB::table('categories')->insert([
            'name' => 'Indie',
        ]);
        DB::table('categories')->insert([
            'name' => 'Action',
        ]);
        DB::table('categories')->insert([
            'name' => 'Racing',
        ]);
        DB::table('categories')->insert([
            'name' => 'RPG',
        ]);
        DB::table('categories')->insert([
            'name' => 'Simulation',
        ]);
        DB::table('categories')->insert([
            'name' => 'Sports',
        ]);
        DB::table('categories')->insert([
            'name' => 'Strategy',
        ]);
    }
}
