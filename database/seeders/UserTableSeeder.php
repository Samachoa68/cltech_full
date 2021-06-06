<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Admin;
use App\Models\Roles;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();

        $adminRoles = Roles::where('roles_name','admin')->first();
        $authorRoles = Roles::where('roles_name','author')->first();
        $userRoles = Roles::where('roles_name','user')->first();

        $admin = Admin::create([
        	'admin_name' => 'Admin_LGT',
        	'admin_email' => 'lamgiatechnology@gmail.com',
        	'admin_phone' => '0939598268',
        	'admin_password' => md5('22686868')
        ]);

        $author = Admin::create([
        	'admin_name' => 'LGTauthor',
        	'admin_email' => 'lgtauthor@yahoo.com',
        	'admin_phone' => '123456789',
        	'admin_password' => md5('123456')
        ]);

        $user = Admin::create([
        	'admin_name' => 'LGTuser',
        	'admin_email' => 'lgtuser@yahoo.com',
        	'admin_phone' => '123456789',
        	'admin_password' => md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);

        factory(App\Admin::class, 20)->create();
    }
}
