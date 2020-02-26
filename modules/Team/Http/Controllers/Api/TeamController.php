<?php

namespace Team\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Team\Http\Requests\TeamRequest;
use Team\Http\Resources\TeamResource;
use Team\Services\TeamServiceInterface;

class TeamController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @param \Team\Services\TeamServiceInterface $service
     */
    public function __construct(TeamServiceInterface $service)
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
        return TeamResource::collection($this->service()->list());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Team\Http\Requests\TeamRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
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
        return new TeamResource($this->service()->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Team\Http\Requests\TeamRequest $request
     * @param  integer                         $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, $id)
    {
        return response()->json($this->service()->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  integer                  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return response()->json($this->service()->destroy($request->has('id') ? $request->input('id') : $id));
    }
}
