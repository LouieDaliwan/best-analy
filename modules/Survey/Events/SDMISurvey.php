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
use User\Models\User;

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
    public $user;

    /**
     * Create a new event instance.
     *
     * @param  \Survey\Models\Field  $field
     * @param  \Survey\Models\Survey $survey
     * @return void
     */
    public function __construct(Survey $survey, User $user,$attributes)
    {
        $this->survey = $survey;
        $this->attributes = $attributes;
        $this->user = $user;
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
