<?php

use App\Product;
use App\Photo;
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
        factory(Product::class, 100)->create();
        factory(Photo::class, 200)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
