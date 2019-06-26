<?php

use Illuminate\Database\Seeder;
use User\Services\RoleServiceInterface;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(RoleServiceInterface $roles)
    {
        $roles->import($allDefaults = true);
    }
}
