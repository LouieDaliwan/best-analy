<?php

namespace Team\Services;

use Core\Application\Service\Concerns\HaveAuthorization;
use Core\Application\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Team\Models\Team;

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
        ];
    }
}
