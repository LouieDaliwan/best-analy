<?php

namespace Core\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Send the data as JSON.
     *
     * @param  mixed $data
     * @return \Illuminate\Http\Response
     */
    public function toJSON($data = null)
    {
        return response()->json([
            'data' => $data,
        ]);
    }
}
