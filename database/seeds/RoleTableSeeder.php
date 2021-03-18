<?php

use Illuminate\Database\Seeder;
use App\Roles;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate: khi phát hiện csdl thì sẽ xóa tất cả csdl trong table roles
        Roles::truncate();

        Roles::create(['name'=>'admin']);
        Roles::create(['name'=>'author']);
        Roles::create(['name'=>'user']);


    }
}
