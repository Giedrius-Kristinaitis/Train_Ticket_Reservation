<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as DB;
use App\Role;

class AccountRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => Role::ROLE_ADMIN
        ]);

        DB::table('roles')->insert([
            'name' => Role::ROLE_MANAGER
        ]);
    }
}