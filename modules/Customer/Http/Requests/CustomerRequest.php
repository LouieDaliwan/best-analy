<?php

namespace Customer\Http\Requests;

use Customer\Models\Customer;
use Customer\Services\CustomerServiceInterface;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize()
    {
        return $this->container->make(
            CustomerServiceInterface::class
        )->authorize($this->customer);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //validation for period
        if (! empty($this->request->get('metadata')['statement'])){

            if($this->request->get('metadata')['setMethod'] == 'add') {
                $period = $this->request->get('metadata')['statement']['metadataStatements']['period'];

                $customer = Customer::find($this->route('customer'));

                $periods = collect($customer->statements()->get('period')->toArray())
                ->flatten()->flip()->keys();

                if($periods->intersect([$period])->count() > 0) {
                    throw new Exception('The financial period already exists.');
                }

            }
            
        }

        if ($this->request->get('metadata')['project']['project_type'] == null) {
            throw new Exception('Project Type must have a value');
        }

        return $this->container->make(
            CustomerServiceInterface::class
        )->rules($this->route('customer'));
    }
}
