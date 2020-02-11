<?php

namespace Survey\Models\Relations;

use Survey\Models\Submission;
use User\Models\User;

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

    /**
     * Retrieve the submission by user key.
     *
     * @param  \User\Models\User $user
     * @return \Survey\Models\Submission
     */
    public function submissionBy(User $user)
    {
        return $this->submissions()->where('user_id', $user->getKey())->first();
    }

    /**
     * Save the account data [email, username, password]
     * to the details table.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function submit(array $attributes)
    {
        $submission = $this->submissions()->create($attributes);
        $this->fireModelEvent('submitted', false, $submission);

        return $this;
    }
}
