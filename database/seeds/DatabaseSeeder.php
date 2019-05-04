<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(ProductStatusTableSeeder::class);

        $this->call(TagTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ShipmentSeeder::class);

        //In product seeder, links to tags and categories are also made (by filling relation-tables)
        $this->call(ProductTableSeeder::class);
        $this->call(ProductImageTableSeeder::class);
//        $this->call(ProductImageTableSeeder::class);
        //$user = factory(\App\User::class)->make();

//        factory(\App\Tag::class, 10)->create();

//        factory(\App\Category::class, 10)->create();

        factory(\App\User::class, 5)->create()->each(function ($user) {
            $user->addresses()->saveMany(factory(\App\Address::class, 3)->make());
        });

        //DONE factory(\App\Supplier::class, 10)->create()->each(function ($supplier) {
        //DONE     $supplier->products()->saveMany(factory(\App\Product::class, 50)->create([
        //DONE         'supplier_id' => $supplier->id,
        //     ])->each(function ($product) {

        //DONE         $product->productImages()->saveMany(factory(\App\ProductImage::class, 3)->make());

        //DONE         $tags = \App\Tag::all();
        //DONE         $product->tags()->attach($tags->random(rand(1, 3))->pluck('id')->toArray());

        //DONE         $categories = \App\Category::all();
        //DONE         $product->categories()->attach($categories->random(rand(1, 3))->pluck('id')->toArray());

        //????         $product->specifications()->saveMany(factory(\App\Specification::class, rand(5, 10))->make());
        //     }));
        // });

        //FOR CORNEN: SITE!!!! https://data.world/craigkelly/steam-game-data/workspace/query?queryid=46d4638d-8ece-4736-aa92-e8068362a37d
        //FOR OTHERS + CORNEN: ORIGINAL SITE! https://data.world/craigkelly/steam-game-data/
    }
}
