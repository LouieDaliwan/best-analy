<?php

namespace Subscription\Models\Relations;

use Subscription\Models\Subscription;

trait HasSubscriptions
{
    /**
     * Get all of the subcriptions for the resource.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function subscriptions()
    {
        return $this->morphToMany(Subscription::class, 'subscribable');
    }
}
