<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RicoaUsersSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RankSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(PolicySeeder::class);
        $this->call(PerformanceSeeder::class);
    }
}
