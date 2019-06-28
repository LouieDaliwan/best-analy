<?php

namespace Core\Application\Service;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Service implements ServiceInterface
{
    use Concerns\HavePagination,
        Concerns\HaveSortOrder,
        Concerns\HaveSoftDeletes,
        Concerns\SearchCapable;

    /**
     * The property on class instances.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The User model instance.
     *
     * @var \Illuminate\Auth\Authenticatable
     */
    protected $user;

    /**
     * The table name.
     *
     * @var string
     */
    protected $table;

    /**
     * Constructor to bind model to a repository.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @param  \Illuminate\Http\Request            $request
     * @return void
     */
    public function __construct(Model $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
        $this->table = $model->getTable();
    }

    /**
     * Retrieve the model object.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Retrieve the model's table name.
     *
     * @return string
     */
    public function table(): string
    {
        return $this->table ?? $this->model()->getTable();
    }

    /**
     * Retrieve the model's table name.
     *
     * @return string
     */
    public function getTable(): string
    {
        return $this->table();
    }

    /**
     * Retrieve the request attribute.
     *
     * @return \Illuminate\Http\Request
     */
    public function request()
    {
        return $this->request;
    }

    /**
     * Retrieve all model resources as array.
     *
     * @return object
     */
    public function all(): object
    {
        return $this->model()->all();
    }

    /**
     * Retrieve model collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get():? Collection
    {
        return $this->model()->get();
    }

    /**
     * Retrieve model resource details.
     *
     * @param  integer $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id):? Model
    {
        return $this->model()->findOrFail($id);
    }

    /**
     * Create model resource.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        return $this->model()->create($attributes);
    }

    /**
     * Update model resource.
     *
     * @param  integer $id
     * @param  array   $attributes
     * @return boolean
     */
    public function update(int $id, array $attributes): bool
    {
        return $this->model()->find($id)->update($attributes);
    }

    /**
     * Permanently delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function delete($id)
    {
        $this
            ->model()
            ->withTrashed()
            ->whereIn($this->model()->getKeyName(), (array) $id)
            ->each(function ($resource) {
                $resource->forceDelete();
            });
    }

    /**
     * Soft delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function destroy($id)
    {
        $this
            ->model()
            ->whereIn($this->model()->getKeyName(), (array) $id)
            ->each(function ($resource) {
                $resource->delete();
            });
    }

    /**
     * Restore model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function restore($id)
    {
        $this
            ->model()
            ->withTrashed()
            ->whereIn($this->model()->getKeyName(), (array) $id)
            ->each(function ($resource) {
                $resource->restore();
            });
    }

    /**
     * Intantiate a new Repository class.
     *
     * @param  string $repository
     * @return \Core\Application\Repository\Repository
     */
    protected function repo(string $repository)
    {
        return app($repository);
    }

    /**
     * Call the model's method magically.
     *
     * @param  string $method
     * @param  array  $attributes
     * @return mixed
     */
    public function __call(string $method, array $attributes)
    {
        return call_user_func_array([$this->model(), $method], $attributes);
    }
}
