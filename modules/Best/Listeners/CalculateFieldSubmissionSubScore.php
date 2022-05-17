<?php

namespace Best\Listeners;

use Best\Pro\ScoreMatrix;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Survey\Services\SubmissionServiceInterface;

class CalculateFieldSubmissionSubScore implements ShouldQueue
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
     * @param  Survey\Services\SubmissionServiceInterface $service
     * @return void
     */
    public function __construct(SubmissionServiceInterface $service)
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
        $submission = $event->submission;

        if($event->submission->taxonomy == 'sdmi') {
            $fieldTotal = ScoreMatrix::SCORES_LIST['sdmi'];
            
            $result = $submission->score != 'N/A' ? number_format((int) $submission->score/$fieldTotal, 2) : 'n';
            
            $submission->metadata = [
                'subscore' => 0,
                'average' => $result,
            ]; 
        } else {
            $wts = $submission->submissible->metadata['wts'] ?? 0;
            $score = ScoreMatrix::SCORES_LIST[$submission->results];
            $fieldTotal = $event->field->metadata['total'] ?? 1;
            $submission->metadata = [
                'subscore' => $subscore = $wts*$score,
                'average' => number_format($subscore/$fieldTotal, 2),
            ];
        }
        
        $submission->save();
    }
}
