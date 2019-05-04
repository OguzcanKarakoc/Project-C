<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use database\seeds\PImages;
use App\Product;

class ProductImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pI_string = file_get_contents('database\seeds\PImages.json');
        $pI_Json = json_decode($pI_string, true);
        $product_id = 0;
        $times_run = 0;
        foreach($pI_Json as $pImage):
            $product_id = $product_id + 1;
            if(Product::find($product_id)!=null):
                DB::table('product_images')->insert([
                    'url' => $pImage['url'],
                    'product_id' => $product_id
                ]);
            else:
                continue;
            endif;
            if($product_id == 500):
                if($times_run < 1):
                    $times_run = $times_run + 1;
                    $product_id = 0;
                endif;
            endif;
        endforeach;

    }
}
