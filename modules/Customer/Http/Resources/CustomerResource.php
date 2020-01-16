<?php

namespace Customer\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        $data = collect(array_merge(parent::toArray($request), [
            'name' => $this->name,
            'refnum' => $this->refnum,
            'code' => $this->code,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'created' => $this->created,
            'deleted' => $this->deleted,
            'modified' => $this->modified,
        ]));

        if ($only = $request->get('only')) {
            $data = $data->only($only);
        }

        return $data->toArray();
    }
}
