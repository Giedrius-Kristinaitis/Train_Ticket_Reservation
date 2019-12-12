<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AccountRoleSeeder::class,
            AccountSeeder::class,
            AdminRoleSeeder::class,
            ManagerRoleSeeder::class
        ]);
    }
}
