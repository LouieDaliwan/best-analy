<?php

namespace Team\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\User as UserResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'displayname' => $this->displayname,
            'customers' => $this->customers,
            'reports' => $this->reports,
            'customers:count' => is_null($this->customers) ? 0 : $this->customers->count(),
            'reports:count' => is_null($this->reports) ? 0 : $this->reports->count(),
        ]);
    }
}
