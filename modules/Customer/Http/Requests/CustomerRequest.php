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
        $customer = Customer::find($this->route('customer'));

        if (! empty($this->request->get('metadata')['statement'])){

            if($this->request->get('metadata')['setMethod'] == 'add' && isset($this->request->get('metadata')['statement']['metadataStatements'])) {

                $period = $this->request->get('metadata')['statement']['metadataStatements']['period'];


                $project =  isset($this->request->get('metadata')['project']) ? $this->request->get('metadata')['project']: null;
                $customerDetail = $customer->detail;

                $isUpdateProjectValue = false;

                if($project != null) {
                    if($customerDetail->metadata['investment_value'] != $project['investment_value'] || $customerDetail->metadata['project_type'] != $project['project_type']){
                        $isUpdateProjectValue = true;
                    }
                }

                if(is_null($period) && $customer->detail->metadata['investment_value'] != null && $customer->detail->metadata['project_type'] != null) {
                    if (!$isUpdateProjectValue) {
                        throw new Exception('Period must have a value');
                    }
                }

                if (isset($customer->statements)) {
                    $periods = collect($customer->statements()->get('period')->toArray())
                    ->flatten()->flip()->keys();

                    if ($periods->intersect([$period])->count() > 0) {
                        throw new Exception('The financial period already exists.');
                    }
                }

            }
        }

        if ($customer->statements()->count() < 1) {

            if(!isset($this->request->get('metadata')['project'])) {
                if($customer->detail->metadata['project_type'] == null) {
                    throw new Exception('Project Type must have a value');
                }

                if($customer->detail->metadata['investment_value'] == null) {
                    throw new Exception('Project Type must have a value');
                }
            } else {
                if ($this->request->get('metadata')['project']['investment_value'] == "0") {
                    throw new Exception('Investment Value must have a value');
                }

                if ($this->request->get('metadata')['project']['project_type'] == null) {
                    throw new Exception('Project Type must have a value');
                }
            }
        }

        return $this->container->make(
            CustomerServiceInterface::class
        )->rules($this->route('customer'));
    }
}
