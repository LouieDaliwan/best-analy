<?php

namespace User\Services;

use Core\Application\Service\Helpers\HaveDefaultConfig;
use Core\Application\Service\Service;
use Core\Enumerations\Role as RoleCode;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;
use User\Models\Permission;
use User\Models\Role;

class RoleService extends Service implements RoleServiceInterface
{
    use HaveDefaultConfig;

    /**
     * The Permission model instance.
     *
     * @var \User\Models\Permission
     */
    protected $permission;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \User\Models\Role        $model
     * @param \User\Models\Permission  $permission
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Role $model, Permission $permission, Request $request, Filesystem $files)
    {
        $this->model = $model;
        $this->permission = $permission;
        $this->request = $request;
        $this->files = $files;
    }

    /**
     * Retrieve the default roles
     * from configuration files.
     *
     * @return \Illuminate\Support\Collection
     */
    public function defaults()
    {
        return $this->getDefaultConfigFromFile('config/roles.php')->flatten($depth = 1);
    }

    /**
     * Import the specified resources to storage.
     *
     * @param  mixed $data Setting to true will import all defaults.
     * @return void
     */
    public function import($data = false)
    {
        $this->defaults()->filter(function ($role) use ($data) {
            return is_array($data) ? in_array($role['code'], $data['roles']) : $data;
        })->each(function ($role) {
            $this->updateOrCreate(
                ['code' => $role['code']],
                collect($role)->except('permissions')->toArray()
            )->permissions()->sync(
                $this->permissions($role['permissions'])->pluck('id')->toArray()
            );
        });
    }

    /**
     * Save the contents of the file to database storage.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function upload(UploadedFile $file)
    {
        $roles = $this->toCsv(
            $this->files->getRequire($file->getPathName())
        );

        dd($roles);
    }

    /**
     * Retrieve the permissions query.
     *
     * @param  array|null $codes
     * @return mixed
     */
    protected function permissions($codes = null)
    {
        return is_null($codes) || in_array('*', $codes)
             ? $this->permission
             : $this->permission->whereIn('code', $codes);
    }
}
