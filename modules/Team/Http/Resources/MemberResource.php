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
            'reports:count' => $this->reports && $this->reports->count(),
        ]);
    }
}
