<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Teacher',
            'role_slug' => 'teacher',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Student',
            'role_slug' => 'student',
        ]);

        DB::table('sections')->insert([
            'name' => 'Science',
        ]);
        DB::table('sections')->insert([
            'name' => 'Commerce',
        ]);
        DB::table('sections')->insert([
            'name' => 'Arts',
        ]);
    }
}
