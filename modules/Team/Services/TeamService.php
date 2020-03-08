<?php

namespace Team\Services;

use Core\Application\Service\Concerns\HaveAuthorization;
use Core\Application\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Team\Models\Team;
use User\Models\User;

class TeamService extends Service implements TeamServiceInterface
{
    use HaveAuthorization;

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
     * @param \Team\Models\Team        $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Team $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Define the validation rules for the model.
     *
     * @param  integer|null $id
     * @return array
     */
    public function rules($id = null)
    {
        return [
            'name' => 'required|max:255',
            'code' => ['required', Rule::unique($this->getTable())->ignore($id)],
            'user_id' => 'required|numeric',
            'manager_id' => 'required|numeric',
            'users' => 'required|array',
        ];
    }

    /**
     * Create model resource.
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
        $model = $this->find($id);
        $model = $this->save($model, $attributes);
        return $model->exists();
    }

    /**
     * Create or Update the passed attributes.
     *
     * @param  \Team\Models\Team $model
     * @param  array             $attributes
     * @return \Team\Models\Team
     */
    public function save(Team $model, array $attributes)
    {
        $model->name = $attributes['name'] ?? $model->name;
        $model->code = $attributes['code'] ?? $model->code;
        $model->description = $attributes['description'] ?? $model->description;
        $model->icon = $attributes['icon'] ?? $model->icon;
        $model->user()->associate(User::find($attributes['user_id']));
        $model->manager()->associate(User::find($attributes['manager_id']));
        $model->save();
        $model->members()->sync($attributes['users'] ?? []);

        return $model;
    }
}
