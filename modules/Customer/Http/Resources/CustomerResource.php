<?php

namespace Customer\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Index\Http\Resources\IndexResource;
use Index\Models\Index;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $customer = parent::toArray($request);

        $data = collect(array_merge($customer, [
            'name' => $this->name,
            'refnum' => $this->refnum,
            'code' => $this->code,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'author' => $this->author,
            'counselor' => $this->counselor,
            'created' => $this->created,
            'deleted' => $this->deleted,
            'modified' => $this->modified,
            'indices' => Index::all()->map(function ($index) use ($request) {
                return array_merge(with(new IndexResource($index))->toArray($request), [
                    'is:finished' => $index->survey && $index->survey->isFinishedWithCustomer($this),
                ]);
            })->toArray(),
        ]));

        if ($only = $request->get('only')) {
            $data = $data->only($only);
        }

        return $data->toArray();
    }
}
