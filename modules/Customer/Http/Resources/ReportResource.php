<?php

namespace Customer\Http\Resources;

use Customer\Http\Resources\AllCustomerResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Index\Http\Resources\IndexResource;
use Index\Models\Index;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return collect(array_merge(parent::toArray($request), [
            'customer' => new AllCustomerResource($this->customer),
            'month' => $this->month,
            'remarked' => $this->remarked,
            'author' => $this->author,
            'created' => $this->created,
            'deleted' => $this->deleted,
            'modified' => $this->modified,
            'fileContentBase64' => $this->file,
        ]));
    }
}
