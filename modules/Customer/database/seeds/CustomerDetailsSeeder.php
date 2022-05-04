<?php

use Carbon\Carbon;
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
        // Detail::query()->truncate();
        FinancialStatement::query()->truncate();
        // ApplicantDetail::query()->truncate();

        $customers = Customer::get();

        foreach ($customers as $customer) {

            if (is_null($customer['metadata']) && $customer->id == 31) {
                continue;
            }

            // $this->customerDetail($customer);

            // $this->customerApplicantDetail($customer);

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

        $custome_bs = $customer['metadata']['balance-sheet'];

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
                    'customer_id' => $customer->id,
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
        $metadata['Current Asset'] = 0;

        foreach ($this->getBalanceSheet() as $key => $datum) {
            
            if(collect(['Other Non-Current Liabilities', 'Other Current Liabilities', 'Other Current Assets', 'Current Asset'])->intersect([$key])->isEmpty()){
                $value = isset($customerBS[$key]) ? (int) $customerBS[$key][$year] ?? 0 : 0;
                
                isset($metadata[$key]) ? : $metadata[$key] = $value;
            }
        
            if($key == 'Other Current Assets') {
                $metadata['Other Current Assets'] = (float) $customerBS['Other CA'][$year] ?? 0;
            }

            if ($key == 'Other Current Liabilities') {
                $metadata['Other Current Liabilities'] = (float) $customerBS['Other CL'][$year] ?? 0; 
            }

            if ($key == 'Other Non-Current Liabilities') {
                $metadata[$key] = (float) $customerBS['Other NCL'][$year] ?? 0;
            }

            if (collect(['Cash', 'Trade Receivables', 'Inventories', 'Other Current Assets'])->intersect([$key])->isNotEmpty()) {

                $key = $key == 'Other Current Assets' ? 'Other CA' : $key;

                $metadata['Current Asset'] += (int)$customerBS[$key][$year] ?? 0;
            }

            if (collect(['Other Current Liabilities', 'Trade Payables'])->intersect([$key])->isNotEmpty()) {
                
                $key = $key == 'Other Current Liabilities' ? 'Other CL' : $key;

                $metadata['Current Liabilities'] += (float) $customerBS[$key][$year];
            }

            if (collect(['Other Non-Current Liablities', 'Common Shares Outstanding', "Stockholders' Equity"])->intersect([$key])->isNotEmpty()) {

                $key = $key == 'Other Non-Current Liablities' ? 'Other NCL' : $key;

                $metadata['Non-Current Liabilities'] += (float) $customerBS[$key][$year];
            }            
        }

        return $metadata;
    }

    protected function getResultMetaData(array $metadata, string $year) : array
    {
        $temp_meta_arr = [];
        $temp_meta_arr['period'] = $year;
        $temp_meta_arr['Net Operating Profit/(Loss)'] = 0;

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
                }
            }

            if ($arr_meta_key == 'Raw Materials (direct & indirect)') {
                isset($temp_meta_arr['Raw Materials']) ? : $temp_meta_arr['Raw Materials'] = 0;
                $temp_meta_arr['Raw Materials'] += $temp_meta_arr['Raw Materials (direct & indirect)'];
                
                
            }

            if($arr_meta_key == 'Cost of Good Sold') {
                $temp_meta_arr['Cost of Good'] = $temp_meta_arr['Raw Materials'] + $temp_meta_arr['Direct Production Costs'];
            }
        }
 
        
        $temp_meta_arr['Net Operating Profit/(Loss)'] = $temp_meta_arr['Sales'] - $temp_meta_arr['Cost of Good Sold'];

        unset($temp_meta_arr['Raw Materials (direct & indirect)']);
        return $temp_meta_arr;
    }

    protected function getBalanceSheet()
    {
        return [
            'Current Asset' => 0,
            'Cash' => 0,
            'Trade Receivables' => 0,
            'Inventories' => 0,
            'Other Current Assets' => 0,
            'Fixed Assets' => 0,
            'Current Liabilities' => 0,
            'Trade Payables' => 0,
            'Other Current Liabilities' => 0,
            'Non-Current Liabilities' => 0,
            'Other Non-Current Liablities' => 0,
            "Stockholder's Equity" => 0,
            'Common Shares Outstanding' => 0,
        ];
    }

    protected function getNewMetadata()
    {
        return [
                'Sales' => [],
                'Number of Staff' => [],
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
                'Cost of Good Sold' => [],
                'Marketing Costs' => [],
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
                'Value Added' => [],

                "Staff Salaries & Benefits" => [
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
                // "Ebit" => [
                //     'Profit or (Loss) Before Interest and Income Tax'
                // ],
                'Interest On Loan/Hires' => [
                    'Interest & Charges by Bank',
                    'Interest on Loan',
                    'Interest on Hire Purchase',
                    'Others (Interest on Loan/Hires)',
                ],
                
                'Company Tax' => [
                    'Tax on Company'
                ],
                'Operating Profit/(Loss)[EBT]' => [
                    // 'Profit or (Loss) Before Income Tax'
                ],
            ];
    }
}
