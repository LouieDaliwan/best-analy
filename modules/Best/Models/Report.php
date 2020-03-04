<?php

namespace Best\Models;

use Core\Models\Accessors\CommonAttributes;
use Core\Models\Relations\BelongsToUser;
use Customer\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Survey\Models\Relations\BelongsToSurvey;

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
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return array_merge($this->toArray(), [
            'value' => json_encode($this->value),
            'customer' => $this->customer->name,
        ]);
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
     * Retrieve the file.
     *
     * @return mixed
     */
    public function getFileAttribute()
    {
        try {
            $name = $this->created.$this->key;

            return chunk_split(base64_encode(
                file_get_contents(storage_path("reports/{$this->getKey()}/$name.pdf"))
            ));
        } catch (\Exception $e) {
            unset($e);
        }

        return null;
    }
}
