<?php

namespace Best\Models;

use Adldap\Laravel\Traits\HasLdapUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use User\Models\User;
use User\Models\Role;

class LdapUser extends User
{
    use HasLdapUser;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Get all roles belonging to user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id');
    }
}
