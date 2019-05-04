<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_statuses')->insert([
            'name' => 'Available',
        ]);

        DB::table('product_statuses')->insert([
            'name' => 'Out of stock',
        ]);
    }
}
