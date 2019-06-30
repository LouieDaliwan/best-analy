<?php

use Core\Enumerations\Role as RoleCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use User\Events\UserUpdating;
use User\Services\RoleServiceInterface;
use User\Services\UserServiceInterface;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  \User\Services\UserServiceInterface $service
     * @param  \User\Services\RoleServiceInterface $role
     * @return void
     */
    public function run(UserServiceInterface $service, RoleServiceInterface $role)
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        foreach (config('users.superadmins', []) as $attributes) {
            $user = $service->updateOrCreate(['username' => $attributes['username']], $attributes);
            $user->record($attributes);
            $user->roles()->sync($role->whereIn('code', RoleCode::superadmins())->pluck('id')->toArray());
        }
    }
}
