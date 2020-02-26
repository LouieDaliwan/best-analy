<?php

namespace Team\Models;

use Core\Models\Accessors\CommonAttributes;
use Core\Models\Relations\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use User\Models\User;

class Team extends Model
{
    use BelongsToUser,
        CommonAttributes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Retrieve the members of this team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class);
    }
}
