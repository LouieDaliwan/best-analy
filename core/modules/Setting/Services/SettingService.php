<?php

namespace Setting\Services;

use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Setting\Models\Setting;

class SettingService extends ConfigRepository implements SettingServiceInterface
{
    /**
     * All of the configuration items.
     *
     * @var array
     */
    protected $items = [];

    /**
     * The key column field.
     *
     * @var string
     */
    protected $key = 'key';

    /**
     * The value column field.
     *
     * @var string
     */
    protected $value = 'value';

    /**
     * The property on class instances.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The status value from database.
     *
     * @var integer
     */
    protected $status = 1;

    /**
     * Create a new configuration repository.
     *
     * @param  \Setting\Models\Setting $model
     * @param  array                   $items
     * @return void
     */
    public function __construct(Setting $model, array $items = [])
    {
        $this->model = $model;
        $this->merge($items);
    }

    /**
     * Retrieve the full model instance.
     *
     * @return \Pluma\Models\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Retrieve the key column field.
     *
     * @return string
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Retrieve the value column field.
     *
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Set a given configuration value.
     *
     * @param  array|string $key
     * @param  mixed        $value
     * @return \Setting\Repositories\SettingRepository
     */
    public function set($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            Arr::set($this->items, $key, $value);
        }

        return $this;
    }

    /**
     * Create model resource.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        $this->items = $attributes;

        return $this->save();
    }

    /**
     * Save the settings array to storage.
     *
     * @return void
     */
    public function save()
    {
        foreach ($this->all() as $key => $value) {
            $this->updateOrCreate([
                $this->key() => $key
            ], [
                $this->value() => $value
            ]);
        }
    }

    /**
     * Merge items from database
     * and user defined on runtime.
     *
     * @param  array $items
     * @return void
     */
    public function merge(array $items)
    {
        $this->items = Collection::make($items)->merge(
            $this->model()
            ->whereStatus($this->status)
            ->pluck($this->value, $this->key)
            ->toArray()
        );
    }

    /**
     * @param  string $method
     * @param  array  $attributes
     * @return mixed
     */
    public function __call(string $method, array $attributes)
    {
        return call_user_func_array([$this->model(), $method], $attributes);
    }

    /**
     * Retrieve the item with the given key.
     *
     * @param  string $attribute
     * @return mixed
     */
    public function containsKey($attribute)
    {
        return $this->all()->filter(function ($item, $k) use ($attribute) {
            return str_contains($k, $attribute);
        })->mapWithKeys(function ($item, $key) {
            return [$key => $item];
        });
    }
}
