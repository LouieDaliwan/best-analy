<?php

namespace Survey\Services;

use Core\Application\Service\Concerns\HaveAuthorization;
use Core\Application\Service\Service;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\TranslationLoader\LanguageLine;
use Survey\Events\SDMISurvey;
use Survey\Events\SurveyFinishedSubmitting;
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
     * The key used when checking for unrestrictions.
     *
     * @var string
     */
    protected $unrestrictedKey = 'surveys';

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
        $model->formable()->associate($this->getModelResourceFromString(
            $attributes['formable_type'], $attributes['formable_id']
        ));
        $model->save();

        LanguageLine::updateOrCreate([
            'group' => '*',
            'key' => $attributes['title'],
        ], [
            'group' => '*',
            'text' => [
                'en' => $attributes['title'],
                'ar' => $attributes['title_arabic'] ?? $attributes['title'],
            ],
        ]);

        if (isset($attributes['body']) && ! is_null($attributes['body'])) {
            LanguageLine::updateOrCreate([
                'group' => '*',
                'key' => $attributes['body'],
            ], [
                'group' => '*',
                'text' => [
                    'en' => $attributes['body'],
                    'ar' => $attributes['body_arabic'] ?? $attributes['body'],
                ],
            ]);
        }

        // Create or update survey fields.
        $fields = collect($attributes['fields'] ?? [])->values()->each(function ($field, $i) use ($model) {
            $model->fields()->updateOrCreate([
                'id' => $field['id'] ?? null,
            ], [
                'title' => $field['title'] ?? null,
                'code' => $field['code'] ?? null,
                'type' => $field['type'] ?? null,
                'metadata' => array_merge([
                    'sort' => $i + 1,
                ], $field['metadata'] ?? []),
                'group' => $field['group'] ?? null,
            ]);

            // Add `group` translations.
            LanguageLine::updateOrCreate([
                'group' => '*',
                'key' => $field['group'],
            ], [
                'group' => '*',
                'text' => [
                    'en' => $field['group'],
                    'ar' => $field['group_arabic'] ?? $field['metadata']['group_arabic'] ?? $field['group'],
                ],
            ]);

            // Add `title` translations.
            LanguageLine::updateOrCreate([
                'group' => '*',
                'key' => $field['title'],
            ], [
                'group' => '*',
                'text' => [
                    'en' => $field['title'],
                    'ar' => $field['title_arabic'] ?? $field['metadata']['title_arabic'] ?? $field['title'],
                ],
            ]);

            // Add `comment` translations.
            if (isset($field['metadata']['comment'])) {
                LanguageLine::updateOrCreate([
                    'group' => '*',
                    'key' => $field['metadata']['comment'] ?? null,
                ], [
                    'group' => '*',
                    'text' => [
                        'en' => $field['metadata']['comment'] ?? null,
                        'ar' => $field['metadata']['comment_arabic']
                             ?? $field['metadata']['comment'] ?? null,
                    ],
                ]);
            }
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
     * @param  array                 $attributes
     * @return void
     */
    public function submit(Survey $survey, $attributes)
    {
        foreach ($attributes['fields'] as $attribute) {
            $field = $survey->fields()->findOrFail($attribute['id']);
            $field->submit($attribute['submission'], $attributes['remarks'] ?? null);
        }

        /** Will optimize this @author LouieDaliwan*/
        $taxonomy = !isset($attributes['fields'][0]['submission']['taxonomy']) ? null : $attributes['fields'][0]['submission']['taxonomy'];

        if($taxonomy == 'bgmi') {
            event(new SDMISurvey(
                $survey,
                auth()->user(),
                $attributes ?? []
            ));
        }

        event(new SurveyFinishedSubmitting(
            $survey,
            $attributes ?? []
        ));

        return true;
    }

    /**
     * Retrieve the model from string given an id.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @param  integer                             $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModelResourceFromString($model, $id)
    {
        return with(new $model)->find($id);
    }

    /**
     * Retrieve the submission for the survey.
     *
     * @param  \Survey\Models\Survey $survey
     * @param  array                 $attributes
     * @return mixed
     */
    public function findSubmission(Survey $survey, $attributes)
    {
        return $survey->fields->map(function ($field) use ($attributes) {
            $submissions = $field->submissions();
            $submissions = $submissions->whereCustomerId($attributes['customer_id'])
                ->where('remarks', $attributes['month'])->first();

            return is_null($submissions) ? [] : $submissions->toArray();
        });
    }
}
