<?php

namespace Customer\Models\Attributes;

use Customer\Models\CustomerUser;
use User\Models\User;

trait HasManyUser
{
    /**
     * Retrieve the user that this resource belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->using(CustomerUser::class);
    }

    /**
     * Retrieve the user id key value.
     *
     * @return string
     */
    public function getUserKeyName()
    {
        return $this->userId;
    }

    /**
     * Retrieve the key of the user this resource belongs to.
     *
     * @return integer
     */
    public function getUserKey(): int
    {
        return $this->{$this->getUserKeyName()};
    }
}
