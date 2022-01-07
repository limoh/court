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

        $user4 = User::create([
            'name'          => 'Plaintiff',
            'email'         => 'plaintiff@ecourt.com',
            'password'      => bcrypt('123.eccms'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user4->assignRole('Plaintiff');
        

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

        DB::table('plaintiffs')->insert([
            [
                'user_id'           => $user3->id,
                'gender'            => 'female',
                'phone'             => '0123453389',
                'dateofbirth'       => '1994-12-12',
                'national_ID'       => '32004004',
                'current_address'   => '682-makupa',
                'permanent_address' => '682-makupa',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);
     
    }
}
