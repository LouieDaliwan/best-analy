<?php

namespace User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'created' => $this->created,
            'deleted' => $this->deleted,
            'modified' => $this->modified,
            'permissions' => PermissionResource::collection($this->permissions),
            'status' => $this->status,
        ]));

        if ($only = $request->get('only')) {
            $data = $data->only($only);
        }

        return $data->toArray();
    }
}
