<?php

namespace Customer\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Index\Http\Resources\IndexResource;
use Index\Models\Index;

class AllCustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $latestSubmission = $this->submissions()->latest('updated_at')->first() ?? null;
        $date = "";

        if($latestSubmission) {
            $date = $latestSubmission->updated_at->diffForHumans();
        } else {
            $date = null;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'refnum' => strtoupper($this->refnum),
            'token' => strtoupper($this->token),
            'filenumber' => $this->filenumber,
            'code' => $this->code,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'author' => $this->author,
            'counselor' => $this->applicant->metadata,
            'created' => $this->created,
            'deleted' => $this->deleted,
            'modified' => $date
        ];
    }
}
