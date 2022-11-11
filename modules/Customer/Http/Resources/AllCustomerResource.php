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
            'refnum' => strtoupper($this->refnum),
            'token' => strtoupper($this->token),
            'filenumber' => $this->filenumber,
            'code' => $this->code,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'author' => $this->author,
            'counselor' => $this->detail->metadata,
            'created' => $this->created,
            'deleted' => $this->deleted,
            'modified' => $this->submissions()->latest()->first()->updated_at->diffForHumans() ?? null,
        ];
    }
}
