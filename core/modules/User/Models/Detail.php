<?php

namespace User\Models;

use Core\Enumerations\DetailType;
use Illuminate\Database\Eloquent\Model;
use User\Enumerations\CredentialColumns;
use User\Models\User;

class Detail extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user that owns the details.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the detail type is account
     * and the column key is password.
     *
     * @return boolean
     */
    public function isPasswordField(): bool
    {
        return $this->attributes['key'] == CredentialColumns::PASSWORD
            && $this->attributes['type'] == DetailType::ACCOUNT;
    }

    /**
     * Retrieve the dummy password string.
     *
     * @return string
     */
    public function getPasswordAttribute(): string
    {
        return str_repeat("*", strlen($this->attributes['value']));
    }
}
