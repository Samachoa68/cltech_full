<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        //     DB::table('tbl_admin')->insert([
        //     'admin_email' => 'lamgiatechnology@gmail.com',
        //         'admin_password' => md5('22686868'),
        //         'admin_name' => 'Admin_LGT',
        //         'admin_phone' => '0939598268',
        // ]);

        $this->call(RolesSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
