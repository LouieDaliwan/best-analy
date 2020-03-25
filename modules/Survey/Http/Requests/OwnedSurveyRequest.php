<?php

namespace Survey\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Survey\Services\SurveyServiceInterface;

class OwnedSurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize()
    {
        return $this->container->make(
            SurveyServiceInterface::class
        )->authorize($this->survey, 'surveys');
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