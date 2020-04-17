<?php

namespace Setting\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Setting\Services\SettingServiceInterface;

class SaveBranding extends ApiController
{
    /**
     * Handle the incoming request
     *
     * @param  \Illuminate\Http\Request                  $request
     * @param  \Setting\Services\SettingServiceInterface $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, SettingServiceInterface $service)
    {
        $file = $request->file('file');

        if (! is_null($file)) {
            $uploadPath = public_path();
            $name = 'logo';
            // dd($file);
            $fileName = $name.'.'.$file->getClientOriginalExtension();

            $file->move($uploadPath, $fileName);
            $service->store(['app:logo' => $fileName]);
        }

        return response()->json($service->store($request->except('file')));
    }
}
