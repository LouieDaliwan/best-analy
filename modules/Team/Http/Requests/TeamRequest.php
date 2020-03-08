<?php

namespace Team\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Team\Services\TeamServiceInterface;

class TeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize()
    {
        return $this->container->make(
            TeamServiceInterface::class
        )->authorize($this->team);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->container->make(
            TeamServiceInterface::class
        )->rules($this->route('team'));
    }
}
