<?php

namespace Index\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Index\Http\Requests\DeleteIndexRequest;
use Index\Http\Requests\IndexRequest;
use Index\Http\Requests\OwnedIndexRequest;
use Index\Http\Requests\RestoreIndexRequest;
use Index\Http\Resources\IndexResource;
use Index\Services\IndexServiceInterface;

class IndexController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @param \Index\Services\IndexServiceInterface $service
     */
    public function __construct(IndexServiceInterface $service)
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
        return IndexResource::collection($this->service()->list());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Index\Http\Requests\IndexRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndexRequest $request)
    {
        return $this->service()->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \Index\Http\Requests\OwnedIndexRequest $request
     * @param  integer                                $id
     * @return \Illuminate\Http\Response
     */
    public function show(OwnedIndexRequest $request, int $id)
    {
        return new IndexResource($this->service()->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Index\Http\Requests\IndexRequest $request
     * @param  integer                           $id
     * @return \Illuminate\Http\Response
     */
    public function update(IndexRequest $request, $id)
    {
        return response()->json($this->service()->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Index\Http\Requests\OwnedIndexRequest $request
     * @param  integer|string                         $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OwnedIndexRequest $request, $id)
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
        return IndexResource::collection($this->service()->listTrashed());
    }

    /**
     * Restore the specified resource.
     *
     * @param  \Index\Http\Requests\RestoreIndexRequest $request
     * @param  integer|null                             $id
     * @return \Illuminate\Http\Response
     */
    public function restore(RestoreIndexRequest $request, $id = null)
    {
        return $this->service()->restore($request->has('id') ? $request->input('id') : $id);
    }

    /**
     * Permanently delete the specified resource.
     *
     * @param  \Index\Http\Requests\DeleteIndexRequest $request
     * @param  integer|null                            $id
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteIndexRequest $request, $id = null)
    {
        return $this->service()->delete($request->has('id') ? $request->input('id') : $id);
    }
}
