<?php

namespace Best\Http\Controllers\Report;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Best\Models\Report;
use Best\Services\FormulaServiceInterface;
use Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Best\Http\Controllers\Report\Helper\SvgChart;

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
        Auth::login($report->user);

        $taxonomyId = $request->get('taxonomy_id') ?: $report->value['current:index']['taxonomy']['id'] ?? null;
        $attributes = [
            'customer_id' => $report->customer->getKey(),
            'taxonomy_id' => $taxonomyId,
            'month' => $report->remarks,
        ];
        $data = $service->generate($report->survey, $attributes);
        $data['month:formatted'] = date('M d, Y', strtotime($data['month'] ?? date('Y-m-d')));
        $data['current:pindex']['sitevisit:date:formatted'] = date('M d, Y', strtotime($data['month']));

        $pdf = SnappyPdf::loadHTML(view("best::reports.pdf.$type")->withData($data));

        $filename = $request->get('filename') ?: $report->key;

        $score = 25;
        $svgChart = SvgChart($score, 100);

        if ($request->get('view') == 'blade') {
            return view("best::reports.pdf.$type")->withData($data);
        }

        return $pdf
            ->setPaper('legal')
            ->setOption('enable-javascript', true)
            ->setOption('debug-javascript', true)
            ->stream($filename.'.pdf');
    }
}
