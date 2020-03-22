<?php

namespace Best\Listeners;

use Best\Events\ReportGenerated;
use Best\Services\FormulaServiceInterface;
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
     * @param  \Best\Services\FormulaServiceInterface $service
     * @return void
     */
    public function __construct(FormulaServiceInterface $service)
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
            'key' => $code = sprintf('%s-%s', date('m-Y'), $customer->code),
            'value' => $percentage,
            'group' => $field->group ?? $field->type,
            'type' => 'performance:indicator',
            'reportable_id' => $submission->getKey(),
            'reportable_type' => get_class($submission),
            'customer_id' => $customer->getKey(),
            'taxonomy_id' => $taxonomy->getKey(),
            'form_id' => $form->getKey(),
            'user_id' => user()->getKey(),
            'month' => date('m-Y'),
        ];

        $formulas = $this->service
            ->where('reportable_id', $submission->getKey())
            ->where('customer_id', $customer->getKey())
            ->where('taxonomy_id', $taxonomy->getKey())
            ->where('form_id', $form->getKey())
            ->where('user_id', user()->getKey())
            ->where('month', date('m-Y'))
            ->get();

        $formulas->each->delete();

        $this->service->create($attributes);

        $isLastField = $this->service->where(
            'key', $code
        )->where(
            'customer_id', $customer->getKey()
        )->where(
            'taxonomy_id', $taxonomy->getKey()
        )->where(
            'form_id', $form->getKey()
        )->where(
            'user_id', user()->getKey()
        )->where(
            'month', date('m-Y')
        )->count();

        if ($isLastField === $form->fields->count()) {
            $data = $this->service->generate($form, [
                'customer_id' => $customer->getKey(),
                'taxonomy_id' => $taxonomy->getKey(),
            ]);

            event(new ReportGenerated($data));
        }
    }
}
