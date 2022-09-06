<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'role_id'     => '1',
            'first_name'  => 'Admin',
            'last_name'   => 'Admin',
            'email'       => 'admin@gmail.com',
            'password'    => bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'first_name' => 'Teacher',
            'last_name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('teacher'),
        ]);

        DB::table('users')->insert([
            'role_id' => '3',
            'first_name' => 'Student',
            'last_name' => 'Student',
            'student_id' => '1001',
            'section' => 1,
            'education_year' => 2022,
            'email' => 'student@gmail.com',
            'password' => bcrypt('student'),
        ]);

    }
}
