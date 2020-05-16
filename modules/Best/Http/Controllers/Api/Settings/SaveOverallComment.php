<?php

namespace Best\Http\Controllers\Api\Settings;

use Best\Services\SettingServiceInterface;
use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class SaveOverallComment extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request               $request
     * @param  \Best\Services\SettingServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, SettingServiceInterface $service)
    {
        return response()->json($service->saveOverallComment($request->all()));
    }
}
