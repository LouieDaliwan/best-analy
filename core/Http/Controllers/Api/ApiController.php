<?php

namespace Core\Http\Controllers\Api;

use Core\Application\Repository\WithRepository;
use Core\Application\Service\WithService;
use Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use WithRepository, WithService;

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
