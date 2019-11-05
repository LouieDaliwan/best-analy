<?php

namespace User\Services;

use Core\Application\Service\Service;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use User\Models\User;

class UserService extends Service implements UserServiceInterface
{
    use Concerns\SavesAccountRecord;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $appendToList = ['roles'];

    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Constructor to bind model to a repository.
     *
     * @param \User\Models\User        $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(User $model, Request $request)
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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'username' => [ 'required', Rule::unique('users')->ignore($id)],
            'password' => 'sometimes|required|min:6',
            'roles' => 'required|array',
        ];
    }

    /**
     * Generate random hash key.
     *
     * @param  string $key
     * @return string
     */
    public function hash(string $key)
    {
        return Hash::make($key);
    }
}
