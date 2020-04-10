<?php

namespace Best\Http\Controllers\Report;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Best\Models\Report;
use Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreviewPdfReport extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        app()->setLocale($request->get('lang') ?: 'en');

        if (is_null($request->get('report_id'))) {
            return abort(404);
        }

        $type = $request->get('type') ?: 'index';
        $report = Report::find($request->get('report_id'));
        $data = $report->value;

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
