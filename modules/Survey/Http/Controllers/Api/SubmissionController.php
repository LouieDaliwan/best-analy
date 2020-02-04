<?php

namespace Survey\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Survey\Http\Requests\OwnedSubmissionRequest;
use Survey\Http\Requests\SubmissionRequest;
use Survey\Http\Resources\SubmissionResource;
use Survey\Services\SubmissionServiceInterface;

class SubmissionController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @param \Survey\Services\SubmissionServiceInterface $service
     */
    public function __construct(SubmissionServiceInterface $service)
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
        return SubmissionResource::collection($this->service()->list());
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  \Survey\Http\Requests\SubmissionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubmissionRequest $request)
    {
        return $this->service()->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \Survey\Http\Requests\OwnedSubmissionRequest $request
     * @param  integer                                      $id
     * @return \Illuminate\Http\Response
     */
    public function show(OwnedSubmissionRequest $request, $id = null)
    {
        return new SubmissionResource($this->service()->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Survey\Http\Requests\SubmissionRequest $request
     * @param  integer                                 $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubmissionRequest $request, $id)
    {
        return response()->json($this->service()->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Survey\Http\Requests\OwnedSubmissionRequest $request
     * @param  integer                                      $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OwnedSubmissionRequest $request, $id = null)
    {
        return $this->service()->destroy($request->has('id') ? $request->input('id') : $id);
    }
}
