<?php

namespace Index\Services;

use Core\Application\Service\Concerns\CanUploadFile;
use Core\Application\Service\Concerns\HaveAuthorization;
use Illuminate\Http\Request;
use Index\Models\Index;
use Taxonomy\Services\TaxonomyService;
use User\Models\User;

class IndexService extends TaxonomyService implements IndexServiceInterface
{
    use CanUploadFile,
        HaveAuthorization;

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
     * Property to check if model is ownable.
     *
     * @var boolean
     */
    protected $ownable = true;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \Index\Models\Index      $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Index $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Create a model resource
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        $model = $this->model;

        return $this->save($model, $attributes);
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
        $model = $this->model->findOrFail($id);
        $model = $this->save($model, $attributes);

        return $model->exists();
    }

    /**
     * Create or Update the passed attributes.
     *
     * @param  \Index\Models\Index $model
     * @param  array               $attributes
     * @return \Index\Models\Index
     */
    public function save($model, $attributes)
    {
        $model->name = $attributes['name'];
        $model->alias = $attributes['alias'];
        $model->code = $attributes['code'];
        $model->description = $attributes['description'];
        $model->type = $attributes['type'] ?? $model->type;
        $model->user()->associate(User::find($attributes['user_id']));
        $model->icon = $attributes['photo'] ?? false
            ? $this->upload($attributes['photo'], $model->getTable())
            : $attributes['icon'] ?? null;
        $model->metadata = $attributes['metadata'] ?? null;
        $model->save();

        return $model;
    }
}
