<?php

namespace Customer\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Customer\Http\Requests\CustomerRequest;
use Customer\Http\Requests\OwnedCustomerRequest;
use Customer\Http\Resources\AllCustomerResource;
use Customer\Http\Resources\CustomerResource;
use Customer\Services\CustomerServiceInterface;
use Illuminate\Http\Request;

class CustomerController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @param \Customer\Services\CustomerServiceInterface $service
     */
    public function __construct(CustomerServiceInterface $service)
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
        return AllCustomerResource::collection($this->service()->list());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Customer\Http\Requests\CustomerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        return $this->service()->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return new CustomerResource($this->service()->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\CustomerRequest $request
     * @param  interger                       $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        // $this->service()->update($id, $this->service()->checkFinancialStatementMetadata($request->all()));

        return  response()->json($this->service()->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Customer\Http\Requests\OwnedCustomerRequest $request
     * @param  interger                                     $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OwnedCustomerRequest $request, $id = null)
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
        return CustomerResource::collection($this->service()->listTrashed());
    }

    /**
     * Restore the specified resource.
     *
     * @param  \Customer\Http\Requests\OwnedCustomerRequest $request
     * @param  interger                                     $id
     * @return \Illuminate\Http\Response
     */
    public function restore(OwnedCustomerRequest $request, $id = null)
    {
        return $this->service()->restore($request->has('id') ? $request->input('id') : $id);
    }

    /**
     * Permanently delete the specified resource.
     *
     * @param  \Customer\Http\Requests\OwnedCustomerRequest $request
     * @param  interger|null                                $id
     * @return \Illuminate\Http\Response
     */
    public function delete(OwnedCustomerRequest $request, $id = null)
    {
        return $this->service()->delete($request->has('id') ? $request->input('id') : $id);
    }

    /**
     * Display a listing of the owned resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function owned()
    {
        return AllCustomerResource::collection($this->service()->list());
    }
}
