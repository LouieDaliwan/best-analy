<?php

namespace Customer\Http\Controllers\Api\Crm;

use Core\Http\Controllers\Api\ApiController;
use Customer\Support\Crm\Contracts\CrmInterface;
use Illuminate\Http\Request;

class SendReportDocumentToCrm extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request                     $request
     * @param  \Customer\Support\Crm\Contracts\CrmInterface $crm
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, CrmInterface $crm)
    {
        return response()->json($crm->sendDocument($request->all()));
    }
}
