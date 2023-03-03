<?php

namespace Best\Http\Controllers\Report;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Best\Models\Report;
use Best\Services\FormulaServiceInterface;
use Best\Services\ReportServiceInterface;
use Core\Http\Controllers\Controller;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use User\Models\User;

class PreviewOverallPdfReport extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request              $request
     * @param  \Best\Services\ReportServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ReportServiceInterface $service)
    {
        app()->setLocale($request->get('lang') ?: 'en');

        $type = 'overall';
        $user = User::find($request->get('user'));
        $customer = Customer::find($request->get('customer'));
        $remarks = $request->get('remarks');
        $report = $service->getOverallReportFromUser($user, $customer);

        Auth::login($report['report']->user);

        $attributes = [
            'customer_id' => $report['report']->customer->getKey(),
            'taxonomy_id' => null,
            'month' => $report['report']->remarks,
        ];
        $data = app(FormulaServiceInterface::class)->generate($report['report']->survey, $attributes);
        $data['month:formatted'] = date('M d, Y', strtotime($data['month'] ?? date('Y-m-d')));
        $data['current:pindex']['sitevisit:date:formatted'] = date('M d, Y', strtotime($data['month']));
        $name = sprintf("BEST Overall Report - %s (%s)", $report['customer']->name, $report['report']->remarks);

        if ($request->get('view') == 'blade') {
            return view("best::reports.pdf.$type")->withData($data);
        }

        $pdf = SnappyPdf::loadHTML(view("best::reports.pdf.$type")->withData($data));

        return $pdf
            ->setPaper('legal')
            ->setOption('enable-javascript', true)
            ->setOption('debug-javascript', true)
            ->setOption('disable-smart-shrinking', true)
            ->setOption('enable-smart-shrinking', false)
            ->stream("$name.pdf");
    }
}
