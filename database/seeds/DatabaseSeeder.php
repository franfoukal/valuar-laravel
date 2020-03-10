<?php

use App\Product;
use App\Photo;
use App\User;
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
        factory(Product::class, 400)->create();
        factory(Photo::class, 1000)->create();
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesSeeder::class);
        User::create([
            'name' => 'admin',
            'surname' => 'admin',
            'email' => 'admin@admin.com',
            'roles_id' => 0,
            'active' => 1,
            'password' => bcrypt('admin')
        ]);

    }
}
