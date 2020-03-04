<?php

namespace Best\Listeners;

use Best\Services\ReportServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveGeneratedReport
{
    /**
     * The SubmissionService instance to be used.
     *
     * @var \Survey\Services\SubmissionServiceInterface
     */
    protected $service;

    /**
     * Create the event listener.
     *
     * @param  \Best\Services\ReportServiceInterface $service
     * @return void
     */
    public function __construct(ReportServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        $this->service->store([
            'key' => trans($event->data['current:index']['pindex'].' Report'),
            'value' => $event->data,
            'remarks' => date('m-Y'),
            'customer_id' => $event->data['organisation:profile']['id'],
            'form_id' => $event->data['survey:id'],
            'user_id' => $event->data['user:id'],
        ]);
    }
}
