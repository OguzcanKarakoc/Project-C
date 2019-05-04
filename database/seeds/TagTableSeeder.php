<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'Coop',
        ]);
        DB::table('tags')->insert([
            'name' => 'MMO',
        ]);
        DB::table('tags')->insert([
            'name' => 'Singleplayer',
        ]);
        DB::table('tags')->insert([
            'name' => 'Multiplayer',
        ]);
        DB::table('tags')->insert([
            'name' => 'Subscription',
        ]);
        DB::table('tags')->insert([
            'name' => 'Windows',
        ]);
        DB::table('tags')->insert([
            'name' => 'Linux',
        ]);
        DB::table('tags')->insert([
            'name' => 'Mac',
        ]);
        DB::table('tags')->insert([
            'name' => 'Controller',
        ]);
    }
}
