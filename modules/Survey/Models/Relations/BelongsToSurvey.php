<?php

namespace Survey\Models\Relations;

use Survey\Models\Survey;

trait BelongsToSurvey
{
    /**
     * The form id key.
     *
     * @var string
     */
    protected $surveyId = 'form_id';

    /**
     * Retrieve the form that this resource belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class, $this->getSurveyKeyName());
    }

    /**
     * Retrieve the form id key value.
     *
     * @return string
     */
    public function getSurveyKeyName()
    {
        return $this->surveyId;
    }
}
