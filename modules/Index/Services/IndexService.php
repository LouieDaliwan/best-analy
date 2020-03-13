<?php

namespace Index\Services;

use Core\Application\Service\Concerns\CanUploadFile;
use Core\Application\Service\Concerns\HaveAuthorization;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
     * Define the validation rules for the model.
     *
     * @param  integer|null $id
     * @return array
     */
    public function rules($id = null)
    {
        return [
            'name' => 'required|max:255',
            'alias' => 'required|max:255',
            'code' => ['required', 'max:255', Rule::unique($this->getTable())->ignore($id)],
            'type' => 'required|max:255',
            'metadata.weightage' => 'required|numeric|gt:0|lte:.25',
        ];
    }

    /**
     * Define the validation messages for the model.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'metadata.weightage.required' => 'The weightage field is required',
            'metadata.weightage.gt' => 'The weightage field must be greater than 0',
            'metadata.weightage.lte' => 'The weightage field must be less than or equal 0.25',
        ];
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

    /**
     * Upload the given file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @param  string                        $folder
     * @return string|null
     */
    public function upload(UploadedFile $file, $folder = null)
    {
        $folderName = settings(
            'storage:modules', 'modules'
        ).DIRECTORY_SEPARATOR.date('Y-m-d')
        .DIRECTORY_SEPARATOR.$folder;
        $uploadPath = storage_path($folderName);
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $fileName = $name.'.'.$file->getClientOriginalExtension();

        if ($file->move($uploadPath, $fileName)) {
            return url("storage/$folderName/$fileName");
        }

        return null;
    }
}
