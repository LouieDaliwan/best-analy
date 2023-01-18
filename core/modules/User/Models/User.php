<?php

namespace User\Models;

use Core\Models\Accessors\CommonAttributes;
use Core\Models\Scopes\Typeable;
use Customer\Models\Customer;
use Customer\Models\CustomerUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Accessors\AvatarAttributes,
        Accessors\NameAttributes,
        Concerns\HaveEventsWithParams,
        Relations\BelongsToManyRoles,
        Relations\HasManyDetails,
        CommonAttributes,
        HasApiTokens,
        Notifiable,
        Searchable,
        SoftDeletes,
        Typeable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * User exposed observable events.
     *
     * These are extra user-defined events observers may subscribe to.
     *
     * @var array
     */
    protected $observables = [
        'recorded',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return array_merge($this->toArray(), [
            'displayname' => $this->displayname,
            'role' => $this->role,
        ]);
    }

    /**
     * Retrieve the API-friendly search result that
     * uses text and url.
     *
     * @return array
     */
    public function toSearchableResultsArray()
    {
        return [
            'text' => $this->displayname,
            'url' => [
                'name' => 'users.index',
                'params' => ['id' => $this->getKey()]
            ],
        ];
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class)->using(CustomerUser::class);
    }
}
