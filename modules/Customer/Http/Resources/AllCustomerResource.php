<?php

namespace Customer\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Index\Http\Resources\IndexResource;
use Index\Models\Index;

class AllCustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
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
        ];
    }
}
