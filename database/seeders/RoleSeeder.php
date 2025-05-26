<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Admin', 'slug' => 'admin']);
        Role::create(['name' => 'Dapur', 'slug' => 'dapur']);
        Role::create(['name' => 'Supplier', 'slug' => 'supplier']);
    }
}
