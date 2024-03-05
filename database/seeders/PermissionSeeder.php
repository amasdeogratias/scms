<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate([
            'name' => 'create product'
        ]);
        Permission::firstOrCreate([
            'name' => 'read product'
        ]);
        Permission::firstOrCreate([
            'name' => 'edit product'
        ]);
        Permission::firstOrCreate([
            'name' => 'delete product'
        ]);

        /**
         * assign permissions to roles.
         */

        //assign permissions to admin
        $admin = Role::where('name', 'admin')->first();
        $admin->syncPermissions([
            'create product',
            'read product',
            'edit product',
            'delete product'
        ]);
    }
}
