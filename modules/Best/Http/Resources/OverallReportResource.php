<?php

namespace Customer\Http\Resources;

use Customer\Http\Resources\AllCustomerResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Index\Http\Resources\IndexResource;
use Index\Models\Index;

class OverallReportResource extends JsonResource
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
            'overall:score' => $this->value['overall:score'],
        ];
    }
}
