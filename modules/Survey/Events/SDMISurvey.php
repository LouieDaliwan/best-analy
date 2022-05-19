<?php

namespace Survey\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Survey\Models\Survey;

class SDMISurvey
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
