<?php

use Illuminate\Database\Seeder;
use Customer\Models\Customer;
use Customer\Models\Detail;
use Customer\Models\FinancialStatement;
use Customer\Models\ApplicantDetail;

class CustomerDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //for develop only
        Detail::query()->truncate();
        FinancialStatement::query()->truncate();
        ApplicantDetail::query()->truncate();

        $customers = Customer::get();

        foreach ($customers as $customer) {

            if (is_null($customer['metadata'])) {
                continue;
            }

            $this->customerDetail($customer);

            $this->customerApplicantDetail($customer);

            $this->customerFinancialStatement($customer);
        }
    }


    protected function customerDetail($customer)
    {
        $temp_array = [
            'project_name' => '',
            'project_location' => '',
            'project_type' => '',
            'trade_name_en' => '',
            'trade_name_ar' => '',
            'license_no' => '',
            'funding_program' => '',
            'industry_sector' => '',
            'business_size' => '',
            'description' => '',
        ];


        $customer->detail()->updateOrCreate([
            'metadata' => $temp_array
        ]);
    }

    protected function customerApplicantDetail($customer)
    {
        $metadata = $customer['metadata'];

        $temp_arr = [
            'email' => $metadata['email'] ?? null,
            'address' => $metadata['address'] ?? null,
            'website' => $metadata['website'] ?? null,
            'staffstrength' => $metadata['staffstrength'] ?? null,
            'industry' => $metadata['industry'] ?? null,
            'FileNo' => $metadata['FileNo'] ?? null,
            'FundingRequestNo' => $metadata['FundingRequestNo'] ?? null,
            'SiteVisitDate' => $metadata['SiteVisitDate'] ?? null,
            'BusinessCounselorName' => $metadata['BusinessCounselorName'] ?? null,
            'PeeBusinessCounselorName' => $metadata['PeeBusinessCounselorName'] ?? null,
            'mobile_no' =>  null,
            'contact_person' => null,
            'designation' => null,
        ];

        $customer->applicant()->updateOrCreate([
            'metadata' => $temp_arr,
        ]);
    }

    protected function customerFinancialStatement($customer)
    {
        
    }
}
