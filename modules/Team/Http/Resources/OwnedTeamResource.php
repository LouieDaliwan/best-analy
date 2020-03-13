<?php

namespace Team\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Team\Http\Resources\MemberResource;
use User\Http\Resources\User as UserResource;

class OwnedTeamResource extends JsonResource
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
            'members' => MemberResource::collection($this->members ?? []),
            'lead' => new UserResource($this->manager),
            'author' => $this->author,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);
    }
}
