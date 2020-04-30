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
     * @param  array  $attributes
     * @param  string $remarks
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function submit(array $attributes, $remarks = null)
    {
        $remarks = is_null($remarks ?? null)
            ? date('Y-m-d H:i:s')
            : date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($remarks))));
        $submission = $this->submissions()->updateOrCreate([
            'remarks' => $remarks,
            'submissible_id' => $attributes['submissible_id'] ?? null,
            'user_id' => $attributes['user_id'] ?? null,
            'customer_id' => $attributes['customer_id'] ?? null,
        ], array_merge(
            ['remarks' => $remarks], $attributes
        ));
        $this->fireModelEvent('submitted', false, $submission);

        return $this;
    }
}
