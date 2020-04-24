<?php

namespace Best\Http\Controllers\Report;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Best\Models\Report;
use Best\Services\FormulaServiceInterface;
use Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreviewPdfReport extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request               $request
     * @param  \Best\Services\FormulaServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, FormulaServiceInterface $service)
    {
        app()->setLocale($request->get('lang') ?: 'en');

        if (is_null($request->get('report_id'))) {
            return abort(404);
        }

        $type = $request->get('type') ?: 'index';
        $report = Report::find($request->get('report_id'));
        $taxonomyId = $request->get('taxonomy_id') ?: $report->value['current:index']['taxonomy']['id'] ?? null;
        $attributes = ['customer_id' => $report->customer->getKey(), 'taxonomy_id' => $taxonomyId];
        $data = $service->generate($report->survey, $attributes);

        Auth::login($report->user);

        $pdf = SnappyPdf::loadHTML(view("best::reports.pdf.$type")->withData($data));

        if ($request->get('view') == 'blade') {
            return view("best::reports.pdf.$type")->withData($data);
        }

        return $pdf
            ->setPaper('legal')
            ->setOption('enable-javascript', true)
            ->setOption('debug-javascript', true)
            ->stream($report->key.'.pdf');
    }
}
