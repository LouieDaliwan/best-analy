<?php

namespace Survey\Services;

use Core\Application\Service\Concerns\HaveAuthorization;
use Core\Application\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Survey\Models\Survey;
use User\Models\User;

class SurveyService extends Service implements SurveyServiceInterface
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
     * @param \Survey\Models\Survey    $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Survey $model, Request $request)
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
    public function rules($id = null): array
    {
        return [
            'title' => 'required|max:255',
            'code' => ['required', 'max:255', Rule::unique($this->getTable())->ignore($id)],
            'user_id' => 'required|numeric',
        ];
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
     * @param  \Survey\Models\Field $model
     * @param  array                $attributes
     * @return \Survey\Models\Field
     */
    public function save($model, $attributes)
    {
        $model->title = $attributes['title'];
        $model->code = $attributes['code'];
        $model->body = $attributes['body'];
        $model->type = $attributes['type'] ?? $model->type;
        $model->metadata = $attributes['metadata'] ?? null;
        $model->user()->associate(User::find($attributes['user_id']));
        $model->save();

        // Create or update survey fields.
        $fields = collect($attributes['fields'] ?? [])->each(function ($field) use ($model) {
            $model->fields()->updateOrCreate([
                'id' => $field['id'] ?? null,
            ], [
                'title' => $field['title'] ?? null,
                'code' => $field['code'] ?? null,
                'type' => $field['type'] ?? null,
                'metadata' => $field['metadata'] ?? null,
                'group' => $field['group'] ?? null,
            ]);
        });

        $model->fields()
            ->whereNotIn('id', $fields->pluck('id')->toArray())
            ->delete();

        return $model;
    }

    /**
     * Save the survey answers to submission storage.
     *
     * @param  \Survey\Models\Survey $survey
     * @return void
     */
    public function submit(Survey $survey)
    {
        foreach ($this->request->input('fields') as $field) {
            $model = $survey->fields()->findOrFail($field['id']);
            $model->submissions()->create($field['submission']);
        }
    }
}
