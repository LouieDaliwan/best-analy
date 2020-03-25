<?php

namespace Team\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Team\Exports\TeamsExport;
use Team\Services\TeamServiceInterface;
use User\Models\User;

class CustomerReport extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request            $request
     * @param  \Team\Services\TeamServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request, TeamServiceInterface $service)
    {
        return Excel::download(new TeamsExport($service), 'teams.xlsx');
    }
}
