<?php

namespace Database\Seeders;

use App\Models\Product;
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
        // User::factory(10)->create();

        $this->call([
            AdminSeeder::class,
            OwnerSeeder::class,
            ShopSeeder::class,
            ImageSeeder::class,
            // 20220129_add
            CategorySeeder::class,
            ProductSeeder::class
        ]);
    }
}
