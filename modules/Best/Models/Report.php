<?php

namespace Best\Models;

use Core\Models\Accessors\CommonAttributes;
use Core\Models\Relations\BelongsToUser;
use Customer\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Survey\Models\Relations\BelongsToSurvey;
use Survey\Models\Survey;

class Report extends Model
{
    use BelongsToUser,
        BelongsToSurvey,
        CommonAttributes,
        Searchable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'remarks',
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Retrieve the customer that this resource belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Retrieve the survey that this resource belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class, 'form_id');
    }

    /**
     * Retrieve the modified created_at value.
     *
     * @return string
     */
    public function getCreatedAttribute()
    {
        return date(
            settings('formal:date', 'd-M, Y'),
            strtotime($this->attributes['created_at'])
        );
    }

    /**
     * Retrieve the modified created_at value.
     *
     * @return string
     */
    public function getRemarkedAttribute()
    {
        return date(
            settings('formal:date', 'd-M, Y'),
            strtotime($this->attributes['remarks'])
        );
    }

    /**
     * Retrieve the file.
     *
     * @return mixed
     */
    public function getFileAttribute()
    {
        try {
            $path = $this->value['filepath'] ?? null;

            if (! is_null($path)) {
                return chunk_split(base64_encode(
                    file_get_contents(storage_path($path))
                ));
            }
        } catch (\Exception $e) {
            unset($e);
        }

        return null;
    }

    public static function encodeToBase64($path)
    {
        try {
            if (file_exists($path)) {
                return chunk_split(base64_encode(
                    file_get_contents($path)
                ));
            }
        } catch (\Exception $e) {
            unset($e);
        }

        return null;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return array_merge($this->toArray(), [
            'filepath' => $this->value['filepath'] ?? null,
            'value' => json_encode($this->value),
            'customer' => $this->customer->name,
        ]);
    }
}
