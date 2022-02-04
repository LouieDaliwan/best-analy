<?php

use Illuminate\Database\Seeder;
use Customer\Models\Customer;
use Customer\Models\Detail;
use Customer\Models\FinancialStatement;
use Customer\Models\ApplicantDetail;

class CustomerDetailsSeeder extends Seeder
{
    protected $years = ['Year1', 'Year2', 'Year3'];
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


    protected function customerDetail($customer) : void
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

    protected function customerApplicantDetail($customer) : void
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

    protected function customerFinancialStatement($customer) : void
    {
        $customer_metadata = $customer['metadata']['fps-qa1'];

        foreach ($this->years as $year) {

            $result = $this->getResultMetaData($customer_metadata, $year);

            $customer->statements()->updateOrCreate(
                ['period' => $year,],
                [
                    'customer_id' => $customer->id,
                    'period' => $year,
                    'metadata' => $result
                ]
            );
        }
    }

    protected function getResultMetaData(array $metadata, string $year) : array
    {
        $temp_meta_arr = [];

        $arr_metadata = $this->getNewMetadata();

        foreach ($arr_metadata as $arr_meta_key => $arr_meta_value) {

            if (empty($arr_meta_value)) {
                isset($temp_meta_arr[$arr_meta_key]) ? : $temp_meta_arr[$arr_meta_key] = (int) $metadata[$arr_meta_key][$year];
            }

            if (is_array($arr_meta_value) && !empty($arr_meta_value)) {

                foreach ($arr_meta_value as $parent_key => $parent_value) {

                    if (is_array($parent_value)) {

                        foreach ($parent_value as $child_value) {
                            isset($temp_meta_arr[$arr_meta_key]) ? : $temp_meta_arr[$arr_meta_key] = 0;

                            $temp_meta_arr[$arr_meta_key] += (int) $metadata[$child_value][$year];
                        }

                    } else {
                        isset($temp_meta_arr[$arr_meta_key]) ? : $temp_meta_arr[$arr_meta_key] = 0;

                        if (!isset($metadata[$parent_value])) {
                            continue;
                        }

                        $temp_meta_arr[$arr_meta_key] += (int) $metadata[$parent_value][$year];

                    }

                }

            }

        }

        return $temp_meta_arr;
    }

    protected function getNewMetadata()
    {
        return [
                //'Sales' => [],
                'Purchase of goods and services' => [
                    'Raw Materials (direct & indirect)',
                    'Opening Stocks',
                    'Closing Stocks',
                ],
                'Production Costs' => [
                    'Cargo and Handling',
                    'Part-time/Temporary Labour',
                    "Insurance (not including employee's insurance)",
                    'Transportation',
                    'Utilities',
                    "Maintenance (Building, Plant, and Machinery)",
                    'Lease of Plant and Machinery',
                    'Direct Employee Cost'
                ],
                'General Management Costs' => [
                    'Stationery Supplies and Printing',
                    'Rental',
                    "Insurance (not including employee's insurance)",
                    "Transportation",
                    'Company Car/Bus etc.',
                    "Advertising",
                    "Entertainment",
                    "Food and Drinks",
                    "Telephone and Fax",
                    "Mail and Courier",
                    "Maintenance (Office Equipment)",
                    "Travel",
                    "Audit, Secretarial, and Professional Costs",
                    "Newspapers and Magazines",
                    "Stamp Duty, Filing and Legal",
                    "Bank charges",
                    "Other Administrative Costs",
                ],
                "Labour Expenses" => [
                    'Employee Compensation',
                    "Bonuses",
                    "Provident Fund",
                    "Employee Welfare",
                    "Medical Costs",
                    "Employee Training",
                    "Director's Salary",
                    "Employee Insurance",
                    "Other Labour Expenses",
                ],
                "Depreciation" => [
                    "Buildings",
                    "Plant, Machinery & Equipment",
                    "Others (Depreciation)"
                ],
                "Non-Operating Expenses(Non-Operating Expense Less Income)" => [
                    "Non-Operating Income" => [
                        'Profit from Fixed Assets Sale',
                        'Profit from Foreign Exchange',
                        'Other Income',
                    ],
                    "Non-Operating Costs" => [
                        'Bad Debts',
                        'Donations',
                        'Foreign Exchange Loss',
                        'Loss on Fixed Assets Sale',
                        'Others (Non-Operating Costs)',
                    ],
                ],
                "Taxation" => [
                    'Tax on Property',
                    'Duties (Customs & Excise)',
                    'Levy on Foreign Workers',
                    'Others (excluding Income Tax)',
                ],
                "Ebit" => [
                    'Profit or (Loss) Before Interest and Income Tax'
                ],
                'Interest On Loan/Hires' => [
                    'Interest & Charges by Bank',
                    'Interest on Loan',
                    'Interest on Hire Purchase',
                    'Others (Interest on Loan/Hires)',
                ],
                'Operating Profit/(Loss)[EBT]' => [
                    'Profit or (Loss) Before Income Tax'
                ],
                'Company Tax' => [
                    'Tax on Company'
                ],
                'Net Operating Profit/(Loss)' =>[
                    'Profit or (Loss) After Income Tax'
                ]
            ];
    }
}
