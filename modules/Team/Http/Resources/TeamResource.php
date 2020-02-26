<?php

namespace Team\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'lead' => $this->user,
            'members' => $this->members,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);
    }
}
