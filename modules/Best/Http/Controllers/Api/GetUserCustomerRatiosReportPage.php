<?php

namespace Best\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class GetUserCustomerRatiosReportPage extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request              $request
     * @param  \Customer\Models\Customer             $customer
     * @param  \User\Models\User                     $user
     * @param  \Best\Services\ReportServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Customer $customer, User $user, ReportServiceInterface $service)
    {
        app()->setLocale($request->get('lang') ?: 'en');

        $data = $service->getFinancialRatiosFromUser($user, $customer);

        return view('best::reports.financialratio')->withData($data);
    }
}
