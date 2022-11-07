<?php

namespace Customer\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Customer\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class CheckCustomerTrashedController extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Artisan::call('company:checked-trashed-monthly');
    }
}
