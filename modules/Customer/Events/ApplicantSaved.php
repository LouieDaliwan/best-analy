<?php

namespace Customer\Events;

use Customer\Models\ApplicantDetail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ApplicantSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $applicant;
    public $customer;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ApplicantDetail $applicant)
    {
        $this->applicant = $applicant;
        $this->customer = $applicant->customer;
        $this->user = auth()->user();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
