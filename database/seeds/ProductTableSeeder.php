<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use database\seeds\Products;
use App\Http\Controllers\SupplierController;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplierController = new SupplierController();
        $product_string = file_get_contents('database\seeds\Products.json');
        $productsJson = json_decode($product_string, true);
        $product_id = 0;
        //First make an empty supplier, otherwise it won't work!
        DB::table('suppliers')->insert([
            'full_name' => 'Unknown',
            'email' => 'Unknown',
        ]);
        //Then make all products
        foreach ($productsJson as $product):
            if (strlen($product['title'])>191):
                continue;
            endif;
            $product_id = $product_id + 1;
            $sup_email = $product['sup_email'];
            DB::table('products')->insert([
                'title' => $product['title'],
                'description' => $product['description'],
                'price' => $product['price'],
                'quantity' => 100,
                //supplier_id = int returned by controller after creating new supplier if it did not exist already.
                'supplier_id' => $supplierController->create($sup_email),
                'product_status_id' => 1,
            ]);


            //All Tags
            if ($product['coop']):
                DB::table('tag_products')->insert([
                    'tag_id' => 1,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['mmo']):
                DB::table('tag_products')->insert([
                    'tag_id' => 2,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['singleplayer']):
                DB::table('tag_products')->insert([
                    'tag_id' => 3,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['multiplayer']):
                DB::table('tag_products')->insert([
                    'tag_id' => 4,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['subscription']):
                DB::table('tag_products')->insert([
                    'tag_id' => 5,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['windows']):
                DB::table('tag_products')->insert([
                    'tag_id' => 6,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['linux']):
                DB::table('tag_products')->insert([
                    'tag_id' => 7,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['mac']):
                DB::table('tag_products')->insert([
                    'tag_id' => 8,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['controller']):
                DB::table('tag_products')->insert([
                    'tag_id' => 9,
                    'product_id' => $product_id,
                ]);
            endif;


            //All categories
            if ($product['nongame']):
                DB::table('category_products')->insert([
                    'category_id' => 1,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['adventure']):
                DB::table('category_products')->insert([
                    'category_id' => 2,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['casual']):
                DB::table('category_products')->insert([
                    'category_id' => 3,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['free']):
                DB::table('category_products')->insert([
                    'category_id' => 4,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['indie']):
                DB::table('category_products')->insert([
                    'category_id' => 5,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['action']):
                DB::table('category_products')->insert([
                    'category_id' => 6,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['racing']):
                DB::table('category_products')->insert([
                    'category_id' => 7,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['rpg']):
                DB::table('category_products')->insert([
                    'category_id' => 8,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['simulation']):
                DB::table('category_products')->insert([
                    'category_id' => 9,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['sports']):
                DB::table('category_products')->insert([
                    'category_id' => 10,
                    'product_id' => $product_id,
                ]);
            endif;
            if ($product['strategy']):
                DB::table('category_products')->insert([
                    'category_id' => 11,
                    'product_id' => $product_id,
                ]);
            endif;

        endforeach;
    }
}
