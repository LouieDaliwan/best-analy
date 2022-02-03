<?php

use Illuminate\Database\Seeder;
use Customer\Models\Customer;
use Customer\Models\Detail;
use Customer\Models\FinancialStatement;
use CUstomer\Models\ApplicantDetail;

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

            $customer_metadata = $customer['metadata'];

            if (is_null($customer_metadata)) {
                continue;
            }

            $this->customerDetail($customer_metadata);

            $this->customerApplicantDetail($customer_metadata);

            $this->customerFinancialStatement($customer_metadata);
        }
    }


    protected function customerDetail($metadata)
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
    }

    protected function customerApplicantDetail($metadata)
    {
        $temp_arr = [
            'email' => $metadata['email'],
            'address' => $metadata['address'],
            'website' => $metadata['website'],
            'staffstrength' => $metadata['staffstrength'],
            'industry' => $metadata['industry'],
            'FileNo' => $metadata['FileNo'],
            'FundingRequestNo' => $metadata['FundingRequestNo'],
            'SiteVisitDate' => $metadata['SiteVisiDate'],
            'BusinessCounselorName' => $metadata['BusinessCounselorName'],
            'PeeBusinessCounselorName' => $metadata['PeeBusinessCounselorName'],
            'mobile_no' => '',
            'contact_person' => '',
            'designation' => '',
        ];

        $metadata->applicant->updateOrCreate([
            'metadata' => $temp_arr,
        ]);
    }

    protected function customerFinancialStatement($metadata)
    {

    }
}
