<?php

namespace Survey\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Survey\Http\Requests\OwnedSurveyRequest;
use Survey\Http\Requests\SurveyRequest;
use Survey\Http\Resources\SurveyResource;
use Survey\Services\SurveyServiceInterface;

class SurveyController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @param \Survey\Services\SurveyServiceInterface $service
     */
    public function __construct(SurveyServiceInterface $service)
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
        return SurveyResource::collection($this->service()->list());
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  \Survey\Http\Requests\SurveyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurveyRequest $request)
    {
        return $this->service()->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \Survey\Http\Requests\OwnedSurveyRequest $request
     * @param  integer                                  $id
     * @return \Illuminate\Http\Response
     */
    public function show(OwnedSurveyRequest $request, int $id)
    {
        return new SurveyResource($this->service()->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Survey\Http\Requests\SurveyRequest $request
     * @param  integer                             $id
     * @return \Illuminate\Http\Response
     */
    public function update(SurveyRequest $request, $id)
    {
        return response()->json($this->service()->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Survey\Http\Requests\OwnedSurveyRequest $request
     * @param  integer                                  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OwnedSurveyRequest $request, $id = null)
    {
        return $this->service()->destroy($request->has('id') ? $request->input('id') : $id);
    }

    /**
     * Display a listing of the soft-deleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        return SurveyResource::collection($this->service()->listTrashed());
    }

    /**
     * Restore the specified resource.
     *
     * @param  \Survey\Http\Requests\OwnedSurveyRequest $request
     * @param  integer                                  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(OwnedSurveyRequest $request, $id = null)
    {
        return $this->service()->restore($request->has('id') ? $request->input('id') : $id);
    }

    /**
     * Permanently delete the specified resource.
     *
     * @param  \Survey\Http\Requests\OwnedSurveyRequest $request
     * @param  integer                                  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(OwnedSurveyRequest $request, $id = null)
    {
        return $this->service()->delete($request->has('id') ? $request->input('id') : $id);
    }
}
