<?php

namespace Index\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
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
            'author' => $this->author,
            'created' => $this->created,
            'deleted' => $this->deleted,
            'modified' => $this->modified,
            'survey' => $this->survey,
            'is:finished' => $this->survey && $this->survey->isFinished(),
        ]);
    }
}
