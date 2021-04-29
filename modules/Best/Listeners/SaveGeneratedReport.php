<?php

namespace Best\Listeners;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Best\Models\User;
use Best\Services\FormulaServiceInterface;
use Best\Services\ReportServiceInterface;
use Customer\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Index\Models\Index;
use Library\Models\Library;
use Setting\Models\Setting;
use Survey\Models\Submission;
use Taxonomy\Models\Taxonomy;

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
        // return;
        $attributes = $event->attributes['fields'][0];
        $form = $event->survey;
        $customer = Customer::find($attributes['submission']['customer_id']);
        $field = Submission::where('submissible_id', $attributes['submission']['submissible_id'])->where('submissible_type', $attributes['submission']['submissible_type'])->first();
        $taxonomy = Index::find($form->formable->id);

        $data = app(FormulaServiceInterface::class)->generate($form, [
            'customer_id' => $customer->getKey(),
            'taxonomy_id' => $taxonomy->getKey(),
            'month' => $event->attributes['remarks'] ?? date('m-Y'),
        ], $taxonomy->name);


        $event->data = $data;
        // -------

        $month = $event->data['monthkey'] ?? $event->data['month'] ?? date('m-Y');
        $remarks = $event->data['month'] ?? date('Y-m-d H:i:s');
        $this->service->updateOrCreate([
            'month' => $month,
            'customer_id' => $event->data['organisation:profile']['id'],
            'form_id' => $event->data['survey:id'],
            'user_id' => $event->data['user:id'],
        ], [
            'key' => trans($event->data['current:index']['pindex'].' Report'),
            'value' => array_merge(['filepath' => $this->save($event)], $event->data),
            'remarks' => $remarks,
            'month' => date('m-Y', strtotime($remarks)),
            'customer_id' => $event->data['organisation:profile']['id'],
            'form_id' => $event->data['survey:id'],
            'user_id' => $event->data['user:id'],
        ]);

        $allFourReportsForTheMonth = $this->service
            ->where('month', $month)
            ->where('customer_id', $customer->getKey())->latest('updated_at')->get(); // 4 indices

        if ($allFourReportsForTheMonth->count() == 4) {
            // Then generate the Overall Report.
            $this->generateOverallReport($allFourReportsForTheMonth);
            $this->save($event, 'financialratio', 'Financial Analysis');
        }
    }

    /**
     * Save html to disk.
     *
     * @param  mixed $event
     * @return string
     */
    public function save($event, $type = 'index', $filename = null)
    {
        app()->setLocale(request()->get('lang') ?: 'en');
        // Log::info('called: ------------------');

        $data = $event->data;
        $data['month:formatted'] = date('M d, Y', strtotime($data['month'] ?? date('Y-m-d')));
        $data['current:pindex']['sitevisit:date:formatted'] = date('M d, Y', strtotime($data['month']));

        $refnum = $event->data['current:index']['customer:refnum'];
        $hash = date('d-m-Y');
        $date = date('Y-m-d');
        $name = $filename ?? $event->data['current:index']['pindex'];
        $name = "$name Report - {$refnum}-{$hash}";

        $html = view("best::reports.pdf.$type", ['data' => $data])->render();

        if (! File::exists(storage_path("modules/reports/$date"))) {
            File::makeDirectory(storage_path("modules/reports/$date"), 0755, true, true);
        }

        file_put_contents(storage_path("modules/reports/$date/$name.html"), $html);

        $pdf = SnappyPdf::loadFile(storage_path("modules/reports/$date/$name.html"));

        $path = storage_path("modules/reports/$date/$name.pdf");

        if (file_exists($path)) {
            File::delete($path);
        }

        if (! file_exists($path)) {
            $pdf
                ->setPaper('legal')
                ->setOption('enable-javascript', true)
                ->setOption('javascript-delay', 2000)
                ->setOption('debug-javascript', true)
                ->save($path);
        }

        if ($type == 'financialratio') {
            $month = date('m-Y');
            Library::updateOrCreate([
                'name' => "overall:financialratio:$month",
            ], [
                'pathname' => "modules/reports/$date/$name.pdf",
                'url' => url("modules/reports/$date/$name.pdf"),
            ]);
        }


        return "modules/reports/$date/$name.pdf";



        $refnum = $event->data['current:index']['customer:refnum'];
        $hash = date('d-m-Y');
        $name = "{$event->data['current:index']['pindex']} Report - {$refnum}-{$hash}.html";


        if (! File::exists(storage_path("modules/reports/$date"))) {
            File::makeDirectory(storage_path("modules/reports/$date"), 0755, true, true);
        }

        file_put_contents(storage_path("modules/reports/$date/$name"), $html);

        return "modules/reports/$date/$name";
    }

    /**
     * Generate overall report.
     *
     * @param  \Illuminate\Support\Collection $reports
     * @return void
     */
    protected function generateOverallReport($reports)
    {
        app()->setLocale(request()->get('lang') ?: 'en');

        $type = 'overall';
        $report = $reports->first();
        $remarks = $report->month;
        $user = $report->user;
        $hash = date('d-m-Y');
        $date = date('Y-m-d');

        $attributes = [
            'customer_id' => $report->customer->getKey(),
            'taxonomy_id' => null,
            'month' => $report->remarks,
        ];

        $data = app(FormulaServiceInterface::class)->generate($report->survey, $attributes);
        $data['month:formatted'] = date('M d, Y', strtotime($data['month'] ?? date('Y-m-d')));
        $data['current:pindex']['sitevisit:date:formatted'] = date('M d, Y', strtotime($data['month']));
        $name = sprintf("BEST Overall Report - %s (%s)", $report->customer->name, $remarks);

        $html = view("best::reports.pdf.$type", ['data' => $data])->render();

        if (! File::exists(storage_path("modules/reports/$date"))) {
            File::makeDirectory(storage_path("modules/reports/$date"), 0755, true, true);
        }

        file_put_contents(storage_path("modules/reports/$date/$name.html"), $html);

        $pdf = SnappyPdf::loadFile(storage_path("modules/reports/$date/$name.html"));

        $path = storage_path("modules/reports/$date/$name.pdf");

        if (file_exists($path)) {
            File::delete($path);
        }

        if (! file_exists($path)) {
            $pdf
                ->setPaper('legal')
                ->setOption('enable-javascript', true)
                ->setOption('javascript-delay', 2000)
                ->setOption('debug-javascript', true)
                ->save($path);
        }

        Library::updateOrCreate([
            'name' => "overall:report:$remarks",
        ], [
            'pathname' => "modules/reports/$date/$name.pdf",
            'url' => url("modules/reports/$date/$name.pdf"),
        ]);
    }
}
