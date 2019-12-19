<?php

namespace User\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use User\Http\Requests\UserRequest;
use User\Http\Resources\User as UserResource;
use User\Services\UserServiceInterface;

class UserController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @param \User\Services\UserServiceInterface $service
     */
    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection($this->service()->list());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \User\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        return response()->json($this->service()->store($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  integer                  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
