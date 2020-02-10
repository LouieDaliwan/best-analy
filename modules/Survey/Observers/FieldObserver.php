<?php

namespace Survey\Observers;

use Survey\Events\SurveySubmittedByUser;
use Survey\Models\Field;

class FieldObserver
{
    /**
     * Handle the "submitted" event.
     *
     * @param  \Survey\Models\Field $field
     * @return void
     */
    public function submitted(Field $field)
    {
        event(new SurveySubmittedByUser($field, $field->getEventData('submitted')));
    }
}
