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

class SurveySubmittedByUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The Field model instance.
     *
     * @var \Survey\Models\Field
     */
    public $field;

    /**
     * The Submission model instance.
     *
     * @var \Survey\Models\Submission
     */
    public $submission;

    /**
     * Create a new event instance.
     *
     * @param  \Survey\Models\Field      $field
     * @param  \Survey\Models\Submission $submission
     * @return void
     */
    public function __construct(Field $field, Submission $submission)
    {
        $this->field = $field;
        $this->submission = $submission;
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
