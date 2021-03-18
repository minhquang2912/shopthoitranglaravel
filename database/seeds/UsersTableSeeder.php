<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate(); //truncate để nhỡ bị trùng dữ liệu có trong table admin_roles này rồi thì còn biết

        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = Admin::create([
             'admin_name' =>'mquangadmin',
             'admin_email' =>'admin@gmail.com',
             'admin_phone' => '123456789',
             'admin_password'=> md5('123456')

        ]);
         $author = Admin::create([
             'admin_name' =>'mquangauthor',
             'admin_email' =>'mquangauthor@gmail.com',
             'admin_phone' => '123456789',
             'admin_password'=> md5('123456')

        ]);
          $user = Admin::create([
             'admin_name' =>'mquanguser',
             'admin_email' =>'mquanguser@gmail.com',
             'admin_phone' => '123456789',
             'admin_password'=> md5('123456')

        ]);

         $admin->roles()->attach($adminRoles);
         $author->roles()->attach($authorRoles);
         $user->roles()->attach($userRoles); 

        factory(App\Admin::class, 20)->create();
    }
}
