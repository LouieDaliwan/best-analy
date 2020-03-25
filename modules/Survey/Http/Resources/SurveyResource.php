<?php

namespace Survey\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SurveyResource extends JsonResource
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
            'fields' => $this->fields->toArray(),
            'fields:grouped' => $this->fields->groupBy('group')->toArray(),
            'formable' => $this->formable,
            'modified' => $this->modified,
        ]);
    }
}