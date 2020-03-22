<?php

namespace Best\Listeners;

use Best\Services\ReportServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;

class SaveGeneratedReport implements ShouldQueue
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
        $this->service->updateOrCreate([
            'remarks' => date('m-Y'),
            'customer_id' => $event->data['organisation:profile']['id'],
            'form_id' => $event->data['survey:id'],
            'user_id' => $event->data['user:id'],
        ], [
            'key' => trans($event->data['current:index']['pindex'].' Report'),
            'value' => array_merge(['filepath' => $this->save($event)], $event->data),
            'remarks' => date('m-Y'),
            'customer_id' => $event->data['organisation:profile']['id'],
            'form_id' => $event->data['survey:id'],
            'user_id' => $event->data['user:id'],
        ]);
    }

    /**
     * Save html to disk.
     *
     * @param  mixed $event
     * @return string
     */
    public function save($event)
    {
        $html = view("best::reports.index")->withData($event->data)->render();
        $refnum = $event->data['current:index']['customer:refnum'];
        $hash = date('m-Y');
        $name = "{$event->data['current:index']['pindex']} Report - {$refnum}-{$hash}.html";
        $date = date('Y-m-d');

        if (! File::exists(storage_path("modules/reports/$date"))) {
            File::makeDirectory(storage_path("modules/reports/$date"), 0755, true, true);
        }

        file_put_contents(storage_path("modules/reports/$date/$name"), $html);

        return "modules/reports/$date/$name";
    }
}
