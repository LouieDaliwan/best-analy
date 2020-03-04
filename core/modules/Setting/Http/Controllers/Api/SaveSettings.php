<?php

namespace Setting\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Setting\Services\SettingServiceInterface;

class SaveSettings extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request                  $request
     * @param  \Setting\Services\SettingServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, SettingServiceInterface $service)
    {
        return response()->json($this->service()->store($request->all()));
    }
}
