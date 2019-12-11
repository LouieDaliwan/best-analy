<?php

namespace Core\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Http\Controllers\Controller;

class ValidateToken extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return response()->json(['data' => 'Valid token.']);
    }
}
