<?php

namespace Customer\Http\Controllers\Api\Crm;

use Core\Http\Controllers\Api\ApiController;
use Customer\Support\Crm\Contracts\CrmInterface;
use Customer\Support\Crm\FileNumber;

class FindCustomerFromCrm extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Customer\Support\Crm\FileNumber             $fileNumber
     * @param  \Customer\Support\Crm\Contracts\CrmInterface $crm
     * @return \Illuminate\Http\Response
     */
    public function __invoke(FileNumber $fileNumber, CrmInterface $crm)
    {
        return response()->json($crm->get($fileNumber));
    }
}
