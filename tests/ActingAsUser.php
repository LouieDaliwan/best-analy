<?php

namespace Tests;

use Core\Enumerations\Role;
use User\Models\User;
use User\Services\RoleServiceInterface;

trait ActingAsUser
{
    /**
     * Generate a superadmin user.
     *
     * @return \Illuminate\Foundation\Auth\User
     */
    protected function asSuperAdmin()
    {
        $service = $this->app->make(RoleServiceInterface::class);
        $service->import($withSuperAdmin = true);
        $roles = $service->whereCode(Role::SUPERADMIN)->get();

        $user = factory(User::class)->create();
        $user->roles()->attach($roles->pluck('id')->toArray());

        return $user;
    }
}
