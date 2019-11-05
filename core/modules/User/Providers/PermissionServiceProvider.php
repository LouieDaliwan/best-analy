<?php

namespace User\Providers;

use Core\Application\Sidebar\SidebarKeys;
use Core\Providers\BaseServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use User\Models\Permission;
use User\Models\Role;
use User\Observers\PermissionObserver;
use User\Observers\RoleObserver;

class PermissionServiceProvider extends BaseServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        [Permission::class => PermissionObserver::class],
        [Role::class => RoleObserver::class],
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->bootBeforeGateDefinitions();

        $this->bootGateDefinitions();
    }

    /**
     * Register Gate before definition.
     *
     * @return void
     */
    protected function bootBeforeGateDefinitions()
    {
        Gate::before(function ($user, $code = null) {
            if ($letThrough = in_array($code, SidebarKeys::viewables())) {
                return $letThrough;
            }

            if ($isSuperAdmin = $user->isSuperAdmin()) {
                return $isSuperAdmin;
            }
        });
    }

    /**
     * Register permissions as Gate definitions.
     *
     * @return void
     */
    protected function bootGateDefinitions()
    {
        try {
            if (Schema::hasTable('permissions')) {
                Permission::chunk(200, function ($permissions) {
                    $permissions->each(function ($permission) {
                        Gate::define(
                            $permission->code,
                            function ($user, $resource = null) use ($permission) {
                                return ! is_null($resource)
                                       ? $user->getKey() === ($resource->getUserKeyName() ?? false)
                                       : $user->isPermittedTo($permission->code);
                            }
                        );
                    });
                });
            }
        } catch (\Exception $e) {
            unset($e);
        }
    }
}
