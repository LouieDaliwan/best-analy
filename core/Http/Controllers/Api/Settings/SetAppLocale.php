<?php

namespace Core\Http\Controllers\Api\Settings;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Setting\Services\SettingServiceInterface;

class SetAppLocale extends ApiController
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
        app()->setLocale($request->input('locale'));

        return response()->json($service->set([
            'app:locale' => $request->input('locale')
        ])->save());
    }
}
