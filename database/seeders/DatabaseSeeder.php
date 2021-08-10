<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        // User::factory()->create(10);
        // Category::factory(2)
        //     ->has(Product::factory()->count(2))
        //     ->create();
        // Product::factory(2)->has(Brand::factory()->count(2))->create();
        // Product::factory(2)->has(Image::factory()->count(2))->create();
        Comment::factory(3)->create([
            'user_id' => 1,
            'product_id' => 12
        ]);
    }
}
