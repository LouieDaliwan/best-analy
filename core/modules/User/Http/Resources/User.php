<?php

namespace User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Detail as DetailResource;

class User extends JsonResource
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
            'avatar' => $this->avatar,
            'birthday' => $this->detail('Birthday'),
            'created' => $this->created,
            'details' => DetailResource::collection($this->details),
            'displayname' => $this->displayname,
            'modified' => $this->modified,
            'permissions' => $this->permissions->pluck('code'),
            'role' => $this->role,
        ]));

        if ($only = $request->get('only')) {
            $data = $data->only($only);
        }

        return $data->toArray();
    }
}
