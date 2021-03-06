<?php

use App\Product;
use App\Photo;
use App\User;
use App\Category;
use App\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Material::create([
            'name' => 'Oro',
            'description' => 'simply dummy text of the printing',
            'active' => 1
        ]);

        Material::create([
            'name' => 'Plata',
            'description' => 'simply dummy text of the printing',
            'active' => 1
        ]);

        Category::create([
            'name' => 'Aros',
            'description' => 'simply dummy text of the printing',
            'active' => 1,
            'subcategory_id' => 0,
        ]);

        Category::create([
            'name' => 'Colgantes',
            'description' => 'simply dummy text of the printing',
            'active' => 1,
            'subcategory_id' => 0,
        ]);

        Category::create([
            'name' => 'Anillos',
            'description' => 'simply dummy text of the printing',
            'active' => 1,
            'subcategory_id' => 0,
        ]);

        Category::create([
            'name' => 'Pulseras',
            'description' => 'simply dummy text of the printing',
            'active' => 1,
            'subcategory_id' => 0,
        ]);
        
        factory(Product::class, 400)->create();
        factory(Photo::class, 1000)->create();

        $this->call(RolesSeeder::class);
        $this->call(VoucherSeeder::class);
        User::create([
            'name' => 'admin',
            'surname' => 'admin',
            'email' => 'admin@admin.com',
            'roles_id' => 1,
            'active' => 1,
            'password' => bcrypt('admin')
        ]);

        
    }
}
