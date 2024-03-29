<?php

namespace Index\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Index\Services\IndexServiceInterface;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize()
    {
        return $this->container->make(
            IndexServiceInterface::class
        )->authorize($this->index);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->container->make(
            IndexServiceInterface::class
        )->rules($this->route('index'));
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return $this->container->make(
            IndexServiceInterface::class
        )->messages();
    }
}
