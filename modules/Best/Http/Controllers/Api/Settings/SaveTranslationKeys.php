<?php

namespace Best\Http\Controllers\Api\Settings;

use Best\Services\SettingService;
use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class SaveTranslationKeys extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request      $request
     * @param  \Best\Services\SettingService $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, SettingService $service)
    {
        return response()->json($service->saveTranslationKeys($request->all()));
    }
}
