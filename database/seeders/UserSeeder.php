<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        $superAdmin = User::firstOrCreate([
            'id'                => 1,
            'name'              => 'Deo Amas',
            'email'             => 'superadmin@gmail.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $superAdmin->assignRole('super-admin');
        $superAdmin->save();

        $admin = User::firstOrCreate([
            'id'                => 2,
            'name'              => 'John Doe',
            'email'             => 'admin@gmail.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $admin->assignRole('admin');

        $manufacture = User::firstOrCreate([
            'id'                => 3,
            'name'              => 'Abuu Ismail',
            'email'             => 'abuu@gmail.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $manufacture->assignRole('manufacture');

        $retailer = User::firstOrCreate([
            'id'                => 4,
            'name'              => 'David Wakarungi',
            'email'             => 'david@gmail.com',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $retailer->assignRole('retailer');
    }
}
