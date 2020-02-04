<?php

namespace Survey\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Survey\Services\SubmissionServiceInterface;

class OwnedSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorize to make this request.
     *
     * @return boolean
     */
    public function authorize()
    {
        return $this->container->make(
            SubmissionServiceInterface::class
        )->authorize($this->submission);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
