<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'administrador',
            'description' => 'administrador',
            'active' => 1,
            'permissions_id' => 1
        ]);
        Role::create([
            'name' => 'cliente',
            'description' => 'cliente',
            'active' => 2,
            'permissions_id' => 2
        ]);
    }
}
