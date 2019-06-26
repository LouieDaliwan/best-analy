<?php

namespace User\Models;

use Core\Models\Accessors\CommonAttributes;
use Core\Models\Scopes\Typeable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Accessors\AvatarAttributes,
        Accessors\NameAttributes,
        Concerns\HaveEventsWithParams,
        Relations\BelongsToManyRoles,
        Relations\HasManyDetails,
        CommonAttributes,
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
     * User exposed observable events.
     *
     * @param  string $value
     * @return void
     */
    public function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
