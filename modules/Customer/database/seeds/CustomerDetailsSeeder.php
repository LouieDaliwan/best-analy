<?php

use Customer\Models\Detail;
use Customer\Models\Customer;
use Illuminate\Database\Seeder;
use Customer\Models\ApplicantDetail;
use Customer\Models\FinancialStatement;
use Customer\Services\FinancialRatioInterface;

class CustomerDetailsSeeder extends Seeder
{
    protected $years = ['Year1', 'Year2', 'Year3'];

    protected $statments = [
        'metadataStatements' => [],
        'metadataSheets' => [],
    ];
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
        $customer->detail()->updateOrCreate([
            'metadata' => [
                'project_name' => $customer['name'],
                'project_location' => null,
                'project_type' => null,
                'trade_name_en' => null,
                'trade_name_ar' => null,
                'license_no' => null,
                'funding_program' => null,
                'investment_value' => 0,
                'industry_sector' => null,
                'business_size' => null,
                'description' => null,
            ]
        ]);
    }

    protected function customerApplicantDetail($customer) : void
    {
        $metadata = $customer['metadata'];

        $customer->applicant()->updateOrCreate([
            'metadata' => [
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
            ],
        ]);
    }

    protected function customerFinancialStatement($customer) : void
    {
        $customer_metadata = $customer['metadata']['fps-qa1'];

        $custome_bs = $customer['metadata']['balance-sheet'];;

        foreach ($this->years as $year) {

            $statements = [
                'metadataStatements' => [],
                'metadataSheets' => [],
            ];

            $statements['metadataStatements'] = $this->getResultMetaData($customer_metadata, $year);
            $statements['metadataSheets'] = $this->customerBalanceSheets($custome_bs, $year);

            $customer->statements()->updateOrCreate(
                [
                    'period' => $year,
                    'customer_id' => $year,
                ],
                [
                    'customer_id' => $customer->id,
                    'period' => $year,
                    'metadataStatements' => $statements['metadataStatements'],
                    'metadataSheets' => $statements['metadataSheets'],
                ]
            );

            app(FinancialRatioInterface::class)->compute($customer, $statements);
        }
    }

    protected function customerBalanceSheets($customerBS, $year)
    {
        $metadata = [];

        foreach ($customerBS as $key => $datum) {
            isset($metadata[$key]) ? : $metadata[$key] = (float) $customerBS[$key][$year] ?? 0;
        }

        $metadata['Balance'] = 0;

        return $metadata;
    }

    protected function getResultMetaData(array $metadata, string $year) : array
    {
        $temp_meta_arr = [];
        $temp_meta_arr['period'] = $year;
        $temp_meta_arr['Raw Materials'] = 0;

        $arr_metadata = $this->getNewMetadata();

        foreach ($arr_metadata as $arr_meta_key => $arr_meta_value) {

            if (empty($arr_meta_value)) {

                if(!isset($metadata[$arr_meta_key])) {
                    $temp_meta_arr[$arr_meta_key] = 0;
                    continue;
                }

                isset($temp_meta_arr[$arr_meta_key]) ? : $temp_meta_arr[$arr_meta_key] = (float) $metadata[$arr_meta_key][$year];
            }

            if (is_array($arr_meta_value) && !empty($arr_meta_value)) {

                foreach ($arr_meta_value as $parent_key => $parent_value) {

                    if (is_array($parent_value)) {

                        foreach ($parent_value as $child_value) {

                            isset($temp_meta_arr[$arr_meta_key]) ? : $temp_meta_arr[$arr_meta_key] = 0;

                            $temp_meta_arr[$arr_meta_key] += (float) $metadata[$child_value][$year];
                        }

                    } else {
                        isset($temp_meta_arr[$arr_meta_key]) ? : $temp_meta_arr[$arr_meta_key] = 0;

                        if (!isset($metadata[$parent_value])) {
                            continue;
                        }

                        $temp_meta_arr[$arr_meta_key] += (float) $metadata[$parent_value][$year];
                    }

                    if ($arr_meta_key == 'Raw Materials (direct & indirect)') {
                        $temp_meta_arr['Raw Materials'] += $temp_meta_arr['Raw Materials (direct & indirect)'];
                    }
                }
            }

        }

        $temp_meta_arr['Cost of Good Sold'] = ($temp_meta_arr['Raw Materials']  + ($temp_meta_arr['Direct Production Costs']));

        return $temp_meta_arr;
    }

    protected function getNewMetadata()
    {
        return [
                'Sales' => [],
                'Raw Materials (direct & indirect)' => [],
                'Direct Production Costs' => [
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
                    'Others (Depreciation)'
                ],
                'Marketing Costs' => [],
                'Value Added' => [],
                'Number of Staff' => [],
                'Staff Salaries & Benefits' => [],
                "Other Expense (less Other Income)" => [
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
            ];
    }
}
