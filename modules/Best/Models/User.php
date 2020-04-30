<?php

namespace Best\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use User\Models\User;

class User extends User implements LdapAuthenticatable
{
    use Accessors\AvatarAttributes,
        Accessors\NameAttributes,
        AuthenticatesWithLdap,
        Concerns\HaveEventsWithParams,
        CommonAttributes,
        HasApiTokens,
        Notifiable,
        Relations\BelongsToManyRoles,
        Relations\HasManyDetails,
        Searchable,
        SoftDeletes,
        Typeable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
}
