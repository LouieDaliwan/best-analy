<?php

namespace Survey\Services;

use Core\Application\Service\Concerns\HaveAuthorization;
use Core\Application\Service\Service;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Survey\Events\SurveyFinishedSubmitting;
use Survey\Models\Submission;
use User\Models\User;

class SubmissionService extends Service implements SubmissionServiceInterface
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
     * Property to check if model is ownable
     *
     * @var boolean
     */
    protected $ownable = true;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \Survey\Models\Submission $model
     * @param \Illuminate\Http\Request  $request
     */
    public function __construct(Submission $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Create a model resource.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        $model = $this->model;

        foreach ($attributes as $attribute) {
            $monthkey = date('m-Y', strtotime($attribute['remarks']));
            $model = $model->updateOrCreate([
                'submissible_id' => $attribute['submissible_id'] ?? null,
                'submissible_type' => $attribute['submissible_type'] ?? null,
                'monthkey' => $monthkey,
                'user_id' => $attribute['user_id'] ?? null,
                'customer_id' => $attribute['customer_id'] ?? null,
            ], array_merge(['monthkey' => $monthkey], $attribute));
        }

        event(new SurveyFinishedSubmitting(
            User::find($attribute['user_id'] ?? false),
            $attribute ?? []
        ));

        return $model;
    }

    /**
     * Create or Update the passed attributes.
     *
     * @param  \Survey\Models\Submission $model
     * @param  array                     $attributes
     * @return \Survey\Models\Submission
     */
    public function save($model, $attributes)
    {
        $model->results = $attributes['results'];
        $model->remarks = $attributes['remarks'];
        $model->metadata = $attributes['metadata'] ?? null;
        $model->submissible_id = $attributes['submissible_id'];
        $model->submissible_type = $attributes['submissible_type'] ?? $model->submissible_type;
        $model->user()->associate(User::find($attributes['user_id']));
        $model->customer()->associate(Customer::find($attributes['customer_id']));
        $model->save();

        return $model;
    }
}
