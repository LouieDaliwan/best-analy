<?php

namespace Team\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Team\Http\Resources\MemberResource;
use User\Http\Resources\User as UserResource;

class TeamResource extends JsonResource
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
            'manager' => new UserResource($this->manager),
            'lead' => new UserResource($this->manager),
            'members' => MemberResource::collection($this->members),
            'author' => $this->author,
            'created' => $this->created,
            'modified' => $this->modified,
            'deleted' => $this->deleted,
        ]);
    }
}
