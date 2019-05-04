<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipments')->insert([
            'name' => 'DHL',
            'price' => 2.99,
        ]);
        DB::table('shipments')->insert([
            'name' => 'UPS',
            'price' => 3.99,
        ]);
        DB::table('shipments')->insert([
            'name' => 'POST NL',
            'price' => 1.99,
        ]);
    }
}
