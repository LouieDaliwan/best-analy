<?php

namespace Best\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class GetFAQContent extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response()->json([
            'videos' => collect(config('modules.best.faq.videos', []))->filter(function ($videos) {
                return collect($videos)->filter(function ($video) {
                    return user()->isPermittedTo($video['code'] ?? null);
                })->count();
            })->toArray(),
        ]);
    }
}
