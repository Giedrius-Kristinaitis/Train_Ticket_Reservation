<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as DB;
use App\User as User;
use App\Role as Role;

class ManagerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = User::where('email', 'manager@manager.com')->value('id');
        $roleId = Role::where('name', Role::ROLE_MANAGER)->value('id');

        DB::table('role_user')->insert([
            'user_id' => $userId,
            'role_id' => $roleId
        ]);
    }
}