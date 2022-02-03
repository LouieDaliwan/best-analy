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
            'project_name' => 'test project name',
            'project_location' => 'test project location',
            'project_type' => 'test project type',
            'trade_name_en' => 'english',
            'trade_name_ar' => 'arabic',
            'license_no' => 'license',
            'funding_program' => 'funding',
            'industry_sector' => 'industry',
            'business_size' => 'business size',
            'description' => 'test description',
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
            'number' =>  null,
            'contact_person' => null,
            'designation' => null,
            'name' => null,
        ];

        $customer->applicant()->updateOrCreate([
            'metadata' => $temp_arr,
        ]);
    }

    protected function customerFinancialStatement($customer)
    {
        
    }
}
