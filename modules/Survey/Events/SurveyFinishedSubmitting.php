<?php

namespace Survey\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Survey\Models\Field;
use Survey\Models\Submission;
use Survey\Models\Survey;

class SurveyFinishedSubmitting
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The Field model instance.
     *
     * @var \Survey\Models\Field
     */
    public $attributes;

    /**
     * The Submission model instance.
     *
     * @var \Survey\Models\Submission
     */
    public $survey;

    /**
     * Create a new event instance.
     *
     * @param  \Survey\Models\Field  $field
     * @param  \Survey\Models\Survey $survey
     * @return void
     */
    public function __construct(Survey $survey, $attributes)
    {
        $this->survey = $survey;
        $this->attributes = $attributes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
