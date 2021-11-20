<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolesAndPermissionsSeeder::class);

        $user = User::create([
            'name'          => 'Admin',
            'email'         => 'admin@ecourt.com',
            'password'      => bcrypt('123.eccms'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user->assignRole('Admin');

        $user2 = User::create([
            'name'          => 'Judge',
            'email'         => 'judge@ecourt.com',
            'password'      => bcrypt('123.eccms'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user2->assignRole('Judge');

        $user3 = User::create([
            'name'          => 'Lawyer',
            'email'         => 'lawyer@ecourt.com',
            'password'      => bcrypt('123.eccms'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user3->assignRole('Lawyer');
/*
        $user4 = User::create([
            'name'          => 'Student',
            'email'         => 'student@demo.com',
            'password'      => bcrypt('12345678'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user4->assignRole('Student');
        */

        DB::table('lawyers')->insert([
            [
                'user_id'           => $user2->id,
                'gender'            => 'male',
                'phone'             => '0123456789',
                'dateofbirth'       => '1980-04-11',
                'national_ID'       => '21000001',
                'current_address'   => '4th-avenue',
                'permanent_address' => '4th-avenue',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('judges')->insert([
            [
                'user_id'           => $user3->id,
                'gender'            => 'female',
                'phone'             => '0123456789',
                'dateofbirth'       => '1964-12-12',
                'national_ID'       => '20000004',
                'current_address'   => '682-karen',
                'permanent_address' => '682-karen',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);

      /*  DB::table('grades')->insert([
            'teacher_id'        => 1,
            'class_numeric'     => 1,
            'class_name'        => 'One',
            'class_description' => 'class one'
        ]);

        DB::table('students')->insert([
            [
                'user_id'           => $user4->id,
                'parent_id'         => 1,
                'class_id'          => 1,
                'roll_number'       => 1,
                'gender'            => 'male',
                'phone'             => '0123456789',
                'dateofbirth'       => '1993-04-11',
                'current_address'   => 'Dhaka-1215',
                'permanent_address' => 'Dhaka-1215',
                'created_at'        => date("Y-m-d H:i:s")
            ]
            
        ]);*/
    }
}
