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
            'deleted' => $this->deleted,
            'details' => $this->details->mapWithKeys(function ($detail) {
                return [$detail->key => $detail];
            }),
            'displayname' => $this->displayname,
            'modified' => $this->modified,
            'permissions' => $this->permissions->pluck('code'),
            'roles' => $this->roles->pluck('id'),
            'role' => $this->role,
        ]));

        if ($only = $request->get('only')) {
            $data = $data->only($only);
        }

        return $data->toArray();
    }
}
