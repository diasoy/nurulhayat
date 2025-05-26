<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user untuk role admin
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@nurulhayat.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $adminRole = Role::where('slug', 'admin')->first();
        if ($adminRole) {
            $adminUser->roles()->attach($adminRole);
        }

        // Buat user untuk role dapur
        $dapurUser = User::create([
            'name' => 'Dapur User',
            'email' => 'dapur@nurulhayat.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $dapurRole = Role::where('slug', 'dapur')->first();
        if ($dapurRole) {
            $dapurUser->roles()->attach($dapurRole);
        }

        // Buat user untuk role supplier
        $supplierUser = User::create([
            'name' => 'Supplier User',
            'email' => 'supplier@nurulhayat.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        $supplierRole = Role::where('slug', 'supplier')->first();
        if ($supplierRole) {
            $supplierUser->roles()->attach($supplierRole);
        }
    }
}