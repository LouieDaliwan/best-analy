<?php

namespace Survey\Models\Relations;

use Survey\Models\Submission;

trait MorphManySubmissions
{
    /**
     * Get all of the submissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function submissions()
    {
        return $this->morphMany(Submission::class, 'submissible');
    }
}
