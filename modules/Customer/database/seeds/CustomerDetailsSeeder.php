<?php

use Illuminate\Database\Seeder;
use Customer\Models\Customer;
use Customer\Models\Detail;
use Customer\Models\FinancialStatement;

class CustomerDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::get();

        foreach ($customers as $customer) {

            $this->customerDetail($customer);

            $this->customerApplicantDetail($customer);
        }
    }


    protected function customerDetail($customer)
    {

    }

    protected function customerApplicantDetail($customer)
    {
        $metadata = [
            'email' => $customer['email'],
            'address' => $customer['address'],
            'website' => $customer['website'],
            'staffstrength' => $customer['staffstrength'],
            'industry' => $customer['industry'],
            'FileNo' => $customer['FileNo'],
            'FundingRequestNo' => $customer['FundingRequestNo'],
            'SiteVisitDate' => $customer['SiteVisiDate'],
            'BusinessCounselorName' => $customer['BusinessCounselorName'],
            'PeeBusinessCounselorName' => $customer['PeeBusinessCounselorName']

        ];

        $customer->applicant->updateOrCreate([
            'metadata' => $metadata,
        ]);
    }
}
