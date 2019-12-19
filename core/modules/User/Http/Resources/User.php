<?php

namespace User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return collect(array_merge(parent::toArray($request), [
            'displayname' => $this->displayname,
            'birthday' => $this->detail('Birthday'),
            'avatar' => $this->avatar,
            'role' => $this->role,
            'permissions' => $this->permissions->pluck('code'),
        ]))->except(['id'])->toArray();
    }
}
