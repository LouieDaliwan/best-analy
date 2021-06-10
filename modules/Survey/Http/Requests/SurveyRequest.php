<?php

namespace Survey\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Survey\Services\SurveyServiceInterface;

class SurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize()
    {

        return true;

        // return $this->container->make(
        //     SurveyServiceInterface::class
        // )->authorize($this->survey);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->container->make(
            SurveyServiceInterface::class
        )->rules($this->route('survey'));
    }
}
