<?php

namespace Best\Listeners;

use Best\Services\ReportServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ComputePerformanceIndexFromSurvey implements ShouldQueue
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
        $field = $event->field;
        $taxonomy = $field->survey->formable;
        $submission = $event->submission;
        $customer = $submission->customer;
        $form = $field->survey;
        $percentage = $submission->metadata['average'] ?? 0;

        $attributes = [
            'key' => $customer->code,
            'value' => $percentage,
            'group' => $field->group ?? $field->type,
            'type' => 'performance:indicator',
            'reportable_id' => $submission->getKey(),
            'reportable_type' => get_class($submission),
            'customer_id' => $customer->getKey(),
            'taxonomy_id' => $taxonomy->getKey(),
            'form_id' => $form->getKey(),
            'user_id' => user()->getKey(),
        ];

        $this->service->store($attributes);
    }
}
