<?php

namespace Best\Pro\Financial;

use Customer\Models\Customer;
use PhpOffice\PhpSpreadsheet\Chart\Renderer\JpGraph;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

abstract class AbstractAnalysis implements Contracts\FinancialAnalysisReportInterface
{
    /**
     * The filepath of the spreadsheet.
     *
     * @var string
     */
    public static $filePath;

    /**
     * Generate the report.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    abstract public static function getReport(Customer $customer);

    /**
     * The destructor method.
     *
     * @return void
     */
    public static function unlinkFile()
    {
        unlink(self::$filePath);
    }

    /**
     * Retrieve the spreadsheet file.
     *
     * @param  string $prefix
     * @return string
     */
    public static function getSpreadsheetFile($prefix = null)
    {
        return base_path("bin/Sheets/{$prefix}BalanceSheets.xlsx");
    }

    /**
     * Copy the spreadsheet file before opening
     * to ensure no other user is using the file.
     *
     * @param  \Customer\Models\Customer $customer
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    public static function getSpreadsheet(Customer $customer)
    {
        $newFile = self::$filePath = self::getSpreadsheetFile(date('YmdHis').rand());
        copy(self::getSpreadsheetFile(), $newFile);

        Settings::setChartRenderer(JpGraph::class);
        $reader = new XlsxReader();
        $reader->setIncludeCharts(true);
        $spreadsheet = $reader->load($newFile);

        $spreadsheet = self::loadCustomerDataToFile($spreadsheet, $customer);

        self::unlinkFile();

        return $spreadsheet;
    }

    /**
     * Load customer financial statements to file.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @param  \Customer\Models\Customer             $customer
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    public static function loadCustomerDataToFile(Spreadsheet $spreadsheet, Customer $customer)
    {
        // Load Customer data to Customer Tab.
        $sheet = $spreadsheet->getSheetByName('Customer');
        $sheet->getCell('B2')->setValue($customer->name);
        $sheet->getCell('B3')->setValue($customer->refnum);
        $sheet->getCell('B4')->setValue($customer->metadata['staffstrength'] ?? null);
        $sheet->getCell('B5')->setValue($customer->metadata['industry'] ?? null);

        // Years labels.
        $sheet = $spreadsheet->getSheetByName('FS_inputs');
        $fsinputs = $customer->metadata['years'] ?? [];
        $sheet->getCell('AC8')->setValue($fsinputs['Years']['Year1'] ?? 'Year 1');
        $sheet->getCell('AI8')->setValue($fsinputs['Years']['Year2'] ?? 'Year 2');
        $sheet->getCell('AO8')->setValue($fsinputs['Years']['Year3'] ?? 'Year 3');
        // Years labels in Balance Sheets.
        $sheet->getCell('BI8')->setValue($fsinputs['Years']['Year1'] ?? 'Year 1');
        $sheet->getCell('BO8')->setValue($fsinputs['Years']['Year2'] ?? 'Year 2');
        $sheet->getCell('BU8')->setValue($fsinputs['Years']['Year3'] ?? 'Year 3');

        // Years labels in ProductivityIndicators.
        $sheet = $spreadsheet->getSheetByName('ProductivityIndicators');
        $fsinputs = $customer->metadata['years'] ?? [];
        $sheet->getCell('D4')->setValue($fsinputs['Years']['Year1'] ?? 'Year 1');
        $sheet->getCell('E4')->setValue($fsinputs['Years']['Year2'] ?? 'Year 2');
        $sheet->getCell('F4')->setValue($fsinputs['Years']['Year3'] ?? 'Year 3');

        // Load Financial Statement Quantitative Assessment 1.
        $sheet = $spreadsheet->getSheetByName('FS_inputs');
        $fsinputs = $customer->metadata['fps-qa1'] ?? [];
        // Sales report.
        $sheet->getCell('AC10')->setValue($fsinputs['Sales']['Year1'] ?? 0);
        $sheet->getCell('AI10')->setValue($fsinputs['Sales']['Year2'] ?? 0);
        $sheet->getCell('AO10')->setValue($fsinputs['Sales']['Year3'] ?? 0);
        // Change in inventory levels.
        // Opening stocks report.
        $sheet->getCell('AC12')->setValue($fsinputs['Opening Stocks']['Year1'] ?? 0);
        $sheet->getCell('AI12')->setValue($fsinputs['Opening Stocks']['Year2'] ?? 0);
        $sheet->getCell('AO12')->setValue($fsinputs['Opening Stocks']['Year3'] ?? 0);
        // Closing stocks report.
        $sheet->getCell('AC13')->setValue($fsinputs['Closing Stocks']['Year1'] ?? 0);
        $sheet->getCell('AI13')->setValue($fsinputs['Closing Stocks']['Year2'] ?? 0);
        $sheet->getCell('AO13')->setValue($fsinputs['Closing Stocks']['Year3'] ?? 0);
        // Raw Materials (direct & indirect) report.
        $sheet->getCell('AC17')->setValue($fsinputs['Raw Materials (direct & indirect)']['Year1'] ?? 0);
        $sheet->getCell('AI17')->setValue($fsinputs['Raw Materials (direct & indirect)']['Year2'] ?? 0);
        $sheet->getCell('AO17')->setValue($fsinputs['Raw Materials (direct & indirect)']['Year3'] ?? 0);
        // Stock Expiring report.
        $sheet->getCell('AC18')->setValue($fsinputs['Stock Expiring']['Year1'] ?? 0);
        $sheet->getCell('AI18')->setValue($fsinputs['Stock Expiring']['Year2'] ?? 0);
        $sheet->getCell('AO18')->setValue($fsinputs['Stock Expiring']['Year3'] ?? 0);
        // Other Materials Used report.
        $sheet->getCell('AC19')->setValue($fsinputs['Other Materials Used']['Year1'] ?? 0);
        $sheet->getCell('AI19')->setValue($fsinputs['Other Materials Used']['Year2'] ?? 0);
        $sheet->getCell('AO19')->setValue($fsinputs['Other Materials Used']['Year3'] ?? 0);
        // Cargo and Handling report.
        $sheet->getCell('AC23')->setValue($fsinputs['Cargo and Handling']['Year1'] ?? 0);
        $sheet->getCell('AI23')->setValue($fsinputs['Cargo and Handling']['Year2'] ?? 0);
        $sheet->getCell('AO23')->setValue($fsinputs['Cargo and Handling']['Year3'] ?? 0);
        // Part-time/Temporary Labour report.
        $sheet->getCell('AC24')->setValue($fsinputs['Part-time/Temporary Labour']['Year1'] ?? 0);
        $sheet->getCell('AI24')->setValue($fsinputs['Part-time/Temporary Labour']['Year2'] ?? 0);
        $sheet->getCell('AO24')->setValue($fsinputs['Part-time/Temporary Labour']['Year3'] ?? 0);
        // Insurance (not including employee\'s insurance) report.
        $sheet->getCell('AC25')->setValue($fsinputs['Insurance (not including employee\'s insurance)']['Year1'] ?? 0);
        $sheet->getCell('AI25')->setValue($fsinputs['Insurance (not including employee\'s insurance)']['Year2'] ?? 0);
        $sheet->getCell('AO25')->setValue($fsinputs['Insurance (not including employee\'s insurance)']['Year3'] ?? 0);
        // Transportation report.
        $sheet->getCell('AC26')->setValue($fsinputs['Transportation']['Year1'] ?? 0);
        $sheet->getCell('AI26')->setValue($fsinputs['Transportation']['Year2'] ?? 0);
        $sheet->getCell('AO26')->setValue($fsinputs['Transportation']['Year3'] ?? 0);
        // Utilities report.
        $sheet->getCell('AC27')->setValue($fsinputs['Transportation']['Year1'] ?? 0);
        $sheet->getCell('AI27')->setValue($fsinputs['Transportation']['Year2'] ?? 0);
        $sheet->getCell('AO27')->setValue($fsinputs['Transportation']['Year3'] ?? 0);
        // Maintenance (Building, Plant, and Machinery) report.
        $sheet->getCell('AC28')->setValue($fsinputs['Maintenance (Building, Plant, and Machinery)']['Year1'] ?? 0);
        $sheet->getCell('AI28')->setValue($fsinputs['Maintenance (Building, Plant, and Machinery)']['Year2'] ?? 0);
        $sheet->getCell('AO28')->setValue($fsinputs['Maintenance (Building, Plant, and Machinery)']['Year3'] ?? 0);
        // Lease of Plant and Machinery report.
        $sheet->getCell('AC29')->setValue($fsinputs['Lease of Plant and Machinery']['Year1'] ?? 0);
        $sheet->getCell('AI29')->setValue($fsinputs['Lease of Plant and Machinery']['Year2'] ?? 0);
        $sheet->getCell('AO29')->setValue($fsinputs['Lease of Plant and Machinery']['Year3'] ?? 0);
        // Other Production Costs report.
        $sheet->getCell('AC30')->setValue($fsinputs['Other Production Costs']['Year1'] ?? 0);
        $sheet->getCell('AI30')->setValue($fsinputs['Other Production Costs']['Year2'] ?? 0);
        $sheet->getCell('AO30')->setValue($fsinputs['Other Production Costs']['Year3'] ?? 0);
        // Stationery Supplies and Printing report.
        $sheet->getCell('AC34')->setValue($fsinputs['Stationery Supplies and Printing']['Year1'] ?? 0);
        $sheet->getCell('AI34')->setValue($fsinputs['Stationery Supplies and Printing']['Year2'] ?? 0);
        $sheet->getCell('AO34')->setValue($fsinputs['Stationery Supplies and Printing']['Year3'] ?? 0);
        // Rental report.
        $sheet->getCell('AC35')->setValue($fsinputs['Rental']['Year1'] ?? 0);
        $sheet->getCell('AI35')->setValue($fsinputs['Rental']['Year2'] ?? 0);
        $sheet->getCell('AO35')->setValue($fsinputs['Rental']['Year3'] ?? 0);
        // Insurance (not including employee's insurance) report.
        $sheet->getCell('AC36')->setValue($fsinputs["Insurance (not including employee's insurance)"]['Year1'] ?? 0);
        $sheet->getCell('AI36')->setValue($fsinputs["Insurance (not including employee's insurance)"]['Year2'] ?? 0);
        $sheet->getCell('AO36')->setValue($fsinputs["Insurance (not including employee's insurance)"]['Year3'] ?? 0);
        // Transportation report.
        $sheet->getCell('AC37')->setValue($fsinputs['Transportation']['Year1'] ?? 0);
        $sheet->getCell('AI37')->setValue($fsinputs['Transportation']['Year2'] ?? 0);
        $sheet->getCell('AO37')->setValue($fsinputs['Transportation']['Year3'] ?? 0);
        // Company Car/Bus etc. report.
        $sheet->getCell('AC38')->setValue($fsinputs['Company Car/Bus etc.']['Year1'] ?? 0);
        $sheet->getCell('AI38')->setValue($fsinputs['Company Car/Bus etc.']['Year2'] ?? 0);
        $sheet->getCell('AO38')->setValue($fsinputs['Company Car/Bus etc.']['Year3'] ?? 0);
        // Advertising report.
        $sheet->getCell('AC39')->setValue($fsinputs['Advertising']['Year1'] ?? 0);
        $sheet->getCell('AI39')->setValue($fsinputs['Advertising']['Year2'] ?? 0);
        $sheet->getCell('AO39')->setValue($fsinputs['Advertising']['Year3'] ?? 0);
        // Entertainment report.
        $sheet->getCell('AC40')->setValue($fsinputs['Entertainment']['Year1'] ?? 0);
        $sheet->getCell('AI40')->setValue($fsinputs['Entertainment']['Year2'] ?? 0);
        $sheet->getCell('AO40')->setValue($fsinputs['Entertainment']['Year3'] ?? 0);
        // Food and Drinks report.
        $sheet->getCell('AC41')->setValue($fsinputs['Food and Drinks']['Year1'] ?? 0);
        $sheet->getCell('AI41')->setValue($fsinputs['Food and Drinks']['Year2'] ?? 0);
        $sheet->getCell('AO41')->setValue($fsinputs['Food and Drinks']['Year3'] ?? 0);
        // Telephone and Fax report.
        $sheet->getCell('AC42')->setValue($fsinputs['Telephone and Fax']['Year1'] ?? 0);
        $sheet->getCell('AI42')->setValue($fsinputs['Telephone and Fax']['Year2'] ?? 0);
        $sheet->getCell('AO42')->setValue($fsinputs['Telephone and Fax']['Year3'] ?? 0);
        // Mail and Courier report.
        $sheet->getCell('AC43')->setValue($fsinputs['Mail and Courier']['Year1'] ?? 0);
        $sheet->getCell('AI43')->setValue($fsinputs['Mail and Courier']['Year2'] ?? 0);
        $sheet->getCell('AO43')->setValue($fsinputs['Mail and Courier']['Year3'] ?? 0);
        // Maintenance (Office Equipment) report.
        $sheet->getCell('AC44')->setValue($fsinputs['Maintenance (Office Equipment)']['Year1'] ?? 0);
        $sheet->getCell('AI44')->setValue($fsinputs['Maintenance (Office Equipment)']['Year2'] ?? 0);
        $sheet->getCell('AO44')->setValue($fsinputs['Maintenance (Office Equipment)']['Year3'] ?? 0);
        // Travel report.
        $sheet->getCell('AC45')->setValue($fsinputs['Travel']['Year1'] ?? 0);
        $sheet->getCell('AI45')->setValue($fsinputs['Travel']['Year2'] ?? 0);
        $sheet->getCell('AO45')->setValue($fsinputs['Travel']['Year3'] ?? 0);
        // Audit, Secretarial, and Professional Costs report.
        $sheet->getCell('AC46')->setValue($fsinputs['Audit, Secretarial, and Professional Costs']['Year1'] ?? 0);
        $sheet->getCell('AI46')->setValue($fsinputs['Audit, Secretarial, and Professional Costs']['Year2'] ?? 0);
        $sheet->getCell('AO46')->setValue($fsinputs['Audit, Secretarial, and Professional Costs']['Year3'] ?? 0);
        // Newspapers and Magazines report.
        $sheet->getCell('AC47')->setValue($fsinputs['Newspapers and Magazines']['Year1'] ?? 0);
        $sheet->getCell('AI47')->setValue($fsinputs['Newspapers and Magazines']['Year2'] ?? 0);
        $sheet->getCell('AO47')->setValue($fsinputs['Newspapers and Magazines']['Year3'] ?? 0);
        // Stamp Duty, Filing and Legal report.
        $sheet->getCell('AC48')->setValue($fsinputs['Stamp Duty, Filing and Legal']['Year1'] ?? 0);
        $sheet->getCell('AI48')->setValue($fsinputs['Stamp Duty, Filing and Legal']['Year2'] ?? 0);
        $sheet->getCell('AO48')->setValue($fsinputs['Stamp Duty, Filing and Legal']['Year3'] ?? 0);
        // Bank charges report.
        $sheet->getCell('AC49')->setValue($fsinputs['Bank charges']['Year1'] ?? 0);
        $sheet->getCell('AI49')->setValue($fsinputs['Bank charges']['Year2'] ?? 0);
        $sheet->getCell('AO49')->setValue($fsinputs['Bank charges']['Year3'] ?? 0);
        // Other Administrative Costs report.
        $sheet->getCell('AC50')->setValue($fsinputs['Other Administrative Costs']['Year1'] ?? 0);
        $sheet->getCell('AI50')->setValue($fsinputs['Other Administrative Costs']['Year2'] ?? 0);
        $sheet->getCell('AO50')->setValue($fsinputs['Other Administrative Costs']['Year3'] ?? 0);
        // Employee Compensation report.
        $sheet->getCell('AC60')->setValue($fsinputs['Employee Compensation']['Year1'] ?? 0);
        $sheet->getCell('AI60')->setValue($fsinputs['Employee Compensation']['Year2'] ?? 0);
        $sheet->getCell('AO60')->setValue($fsinputs['Employee Compensation']['Year3'] ?? 0);
        // Bonuses report.
        $sheet->getCell('AC61')->setValue($fsinputs['Bonuses']['Year1'] ?? 0);
        $sheet->getCell('AI61')->setValue($fsinputs['Bonuses']['Year2'] ?? 0);
        $sheet->getCell('AO61')->setValue($fsinputs['Bonuses']['Year3'] ?? 0);
        // Provident Fund report.
        $sheet->getCell('AC62')->setValue($fsinputs['Provident Fund']['Year1'] ?? 0);
        $sheet->getCell('AI62')->setValue($fsinputs['Provident Fund']['Year2'] ?? 0);
        $sheet->getCell('AO62')->setValue($fsinputs['Provident Fund']['Year3'] ?? 0);
        // Employee Welfare report.
        $sheet->getCell('AC63')->setValue($fsinputs['Employee Welfare']['Year1'] ?? 0);
        $sheet->getCell('AI63')->setValue($fsinputs['Employee Welfare']['Year2'] ?? 0);
        $sheet->getCell('AO63')->setValue($fsinputs['Employee Welfare']['Year3'] ?? 0);
        // Medical Costs report.
        $sheet->getCell('AC64')->setValue($fsinputs['Medical Costs']['Year1'] ?? 0);
        $sheet->getCell('AI64')->setValue($fsinputs['Medical Costs']['Year2'] ?? 0);
        $sheet->getCell('AO64')->setValue($fsinputs['Medical Costs']['Year3'] ?? 0);
        // Employee Training report.
        $sheet->getCell('AC65')->setValue($fsinputs['Employee Training']['Year1'] ?? 0);
        $sheet->getCell('AI65')->setValue($fsinputs['Employee Training']['Year2'] ?? 0);
        $sheet->getCell('AO65')->setValue($fsinputs['Employee Training']['Year3'] ?? 0);
        // Director's Salary report.
        $sheet->getCell('AC66')->setValue($fsinputs["Director's Salary"]['Year1'] ?? 0);
        $sheet->getCell('AI66')->setValue($fsinputs["Director's Salary"]['Year2'] ?? 0);
        $sheet->getCell('AO66')->setValue($fsinputs["Director's Salary"]['Year3'] ?? 0);
        // Employee Insurance report.
        $sheet->getCell('AC67')->setValue($fsinputs['Employee Insurance']['Year1'] ?? 0);
        $sheet->getCell('AI67')->setValue($fsinputs['Employee Insurance']['Year2'] ?? 0);
        $sheet->getCell('AO67')->setValue($fsinputs['Employee Insurance']['Year3'] ?? 0);
        // Other Labour Expenses report.
        $sheet->getCell('AC68')->setValue($fsinputs['Other Labour Expenses']['Year1'] ?? 0);
        $sheet->getCell('AI68')->setValue($fsinputs['Other Labour Expenses']['Year2'] ?? 0);
        $sheet->getCell('AO68')->setValue($fsinputs['Other Labour Expenses']['Year3'] ?? 0);
        // Buildings report.
        $sheet->getCell('AC72')->setValue($fsinputs['Buildings']['Year1'] ?? 0);
        $sheet->getCell('AI72')->setValue($fsinputs['Buildings']['Year2'] ?? 0);
        $sheet->getCell('AO72')->setValue($fsinputs['Buildings']['Year3'] ?? 0);
        // Plant, Machinery & Equipment report.
        $sheet->getCell('AC73')->setValue($fsinputs['Plant, Machinery & Equipment']['Year1'] ?? 0);
        $sheet->getCell('AI73')->setValue($fsinputs['Plant, Machinery & Equipment']['Year2'] ?? 0);
        $sheet->getCell('AO73')->setValue($fsinputs['Plant, Machinery & Equipment']['Year3'] ?? 0);
        // Others (Depreciation) report.
        $sheet->getCell('AC74')->setValue($fsinputs['Others (Depreciation)']['Year1'] ?? 0);
        $sheet->getCell('AI74')->setValue($fsinputs['Others (Depreciation)']['Year2'] ?? 0);
        $sheet->getCell('AO74')->setValue($fsinputs['Others (Depreciation)']['Year3'] ?? 0);
        // Profit from Fixed Assets Sale report.
        $sheet->getCell('AC79')->setValue($fsinputs['Profit from Fixed Assets Sale']['Year1'] ?? 0);
        $sheet->getCell('AI79')->setValue($fsinputs['Profit from Fixed Assets Sale']['Year2'] ?? 0);
        $sheet->getCell('AO79')->setValue($fsinputs['Profit from Fixed Assets Sale']['Year3'] ?? 0);
        // Profit from Foreign Exchange report.
        $sheet->getCell('AC80')->setValue($fsinputs['Profit from Foreign Exchange']['Year1'] ?? 0);
        $sheet->getCell('AI80')->setValue($fsinputs['Profit from Foreign Exchange']['Year2'] ?? 0);
        $sheet->getCell('AO80')->setValue($fsinputs['Profit from Foreign Exchange']['Year3'] ?? 0);
        // Other Income report.
        $sheet->getCell('AC81')->setValue($fsinputs['Other Income']['Year1'] ?? 0);
        $sheet->getCell('AI81')->setValue($fsinputs['Other Income']['Year2'] ?? 0);
        $sheet->getCell('AO81')->setValue($fsinputs['Other Income']['Year3'] ?? 0);
        // Bad Debts report.
        $sheet->getCell('AC83')->setValue($fsinputs['Bad Debts']['Year1'] ?? 0);
        $sheet->getCell('AI83')->setValue($fsinputs['Bad Debts']['Year2'] ?? 0);
        $sheet->getCell('AO83')->setValue($fsinputs['Bad Debts']['Year3'] ?? 0);
        // Donations report.
        $sheet->getCell('AC84')->setValue($fsinputs['Donations']['Year1'] ?? 0);
        $sheet->getCell('AI84')->setValue($fsinputs['Donations']['Year2'] ?? 0);
        $sheet->getCell('AO84')->setValue($fsinputs['Donations']['Year3'] ?? 0);
        // Foreign Exchange Loss report.
        $sheet->getCell('AC85')->setValue($fsinputs['Foreign Exchange Loss']['Year1'] ?? 0);
        $sheet->getCell('AI85')->setValue($fsinputs['Foreign Exchange Loss']['Year2'] ?? 0);
        $sheet->getCell('AO85')->setValue($fsinputs['Foreign Exchange Loss']['Year3'] ?? 0);
        // Loss on Fixed Assets Sale report.
        $sheet->getCell('AC86')->setValue($fsinputs['Loss on Fixed Assets Sale']['Year1'] ?? 0);
        $sheet->getCell('AI86')->setValue($fsinputs['Loss on Fixed Assets Sale']['Year2'] ?? 0);
        $sheet->getCell('AO86')->setValue($fsinputs['Loss on Fixed Assets Sale']['Year3'] ?? 0);
        // Others (Non-Operating Costs) report.
        $sheet->getCell('AC87')->setValue($fsinputs['Others (Non-Operating Costs)']['Year1'] ?? 0);
        $sheet->getCell('AI87')->setValue($fsinputs['Others (Non-Operating Costs)']['Year2'] ?? 0);
        $sheet->getCell('AO87')->setValue($fsinputs['Others (Non-Operating Costs)']['Year3'] ?? 0);
        // Tax on Property report.
        $sheet->getCell('AC91')->setValue($fsinputs['Tax on Property']['Year1'] ?? 0);
        $sheet->getCell('AI91')->setValue($fsinputs['Tax on Property']['Year2'] ?? 0);
        $sheet->getCell('AO91')->setValue($fsinputs['Tax on Property']['Year3'] ?? 0);
        // Duties (Customs & Excise) report.
        $sheet->getCell('AC92')->setValue($fsinputs['Duties (Customs & Excise)']['Year1'] ?? 0);
        $sheet->getCell('AI92')->setValue($fsinputs['Duties (Customs & Excise)']['Year2'] ?? 0);
        $sheet->getCell('AO92')->setValue($fsinputs['Duties (Customs & Excise)']['Year3'] ?? 0);
        // Levy on Foreign Workers report.
        $sheet->getCell('AC93')->setValue($fsinputs['Levy on Foreign Workers']['Year1'] ?? 0);
        $sheet->getCell('AI93')->setValue($fsinputs['Levy on Foreign Workers']['Year2'] ?? 0);
        $sheet->getCell('AO93')->setValue($fsinputs['Levy on Foreign Workers']['Year3'] ?? 0);
        // Others (excluding Income Tax) report.
        $sheet->getCell('AC94')->setValue($fsinputs['Others (excluding Income Tax)']['Year1'] ?? 0);
        $sheet->getCell('AI94')->setValue($fsinputs['Others (excluding Income Tax)']['Year2'] ?? 0);
        $sheet->getCell('AO94')->setValue($fsinputs['Others (excluding Income Tax)']['Year3'] ?? 0);
        // Interest & Charges by Bank report.
        $sheet->getCell('AC101')->setValue($fsinputs['Interest & Charges by Bank']['Year1'] ?? 0);
        $sheet->getCell('AI101')->setValue($fsinputs['Interest & Charges by Bank']['Year2'] ?? 0);
        $sheet->getCell('AO101')->setValue($fsinputs['Interest & Charges by Bank']['Year3'] ?? 0);
        // Interest on Loan report.
        $sheet->getCell('AC102')->setValue($fsinputs['Interest on Loan']['Year1'] ?? 0);
        $sheet->getCell('AI102')->setValue($fsinputs['Interest on Loan']['Year2'] ?? 0);
        $sheet->getCell('AO102')->setValue($fsinputs['Interest on Loan']['Year3'] ?? 0);
        // Interest on Hire Purchase report.
        $sheet->getCell('AC103')->setValue($fsinputs['Interest on Hire Purchase']['Year1'] ?? 0);
        $sheet->getCell('AI103')->setValue($fsinputs['Interest on Hire Purchase']['Year2'] ?? 0);
        $sheet->getCell('AO103')->setValue($fsinputs['Interest on Hire Purchase']['Year3'] ?? 0);
        // Others (Interest on Loan/Hires) report.
        $sheet->getCell('AC104')->setValue($fsinputs['Others (Interest on Loan/Hires)']['Year1'] ?? 0);
        $sheet->getCell('AI104')->setValue($fsinputs['Others (Interest on Loan/Hires)']['Year2'] ?? 0);
        $sheet->getCell('AO104')->setValue($fsinputs['Others (Interest on Loan/Hires)']['Year3'] ?? 0);
        // Tax on Company report.
        $sheet->getCell('AC111')->setValue($fsinputs['Tax on Company']['Year1'] ?? 0);
        $sheet->getCell('AI111')->setValue($fsinputs['Tax on Company']['Year2'] ?? 0);
        $sheet->getCell('AO111')->setValue($fsinputs['Tax on Company']['Year3'] ?? 0);

        // Load Balance Sheet.
        $sheet = $spreadsheet->getSheetByName('FS_inputs');
        $fsinputs = $customer->metadata['balance-sheet'] ?? [];
        if (! empty($fsinputs)) {
            // Current assets cash report.
            $sheet->getCell('BI13')->setValue($fsinputs['Cash']['Year1'] ?? 0);
            $sheet->getCell('BO13')->setValue($fsinputs['Cash']['Year2'] ?? 0);
            $sheet->getCell('BU13')->setValue($fsinputs['Cash']['Year3'] ?? 0);
            // Trade Receivables report.
            $sheet->getCell('BI14')->setValue($fsinputs['Trade Receivables']['Year1'] ?? 0);
            $sheet->getCell('BO14')->setValue($fsinputs['Trade Receivables']['Year2'] ?? 0);
            $sheet->getCell('BU14')->setValue($fsinputs['Trade Receivables']['Year3'] ?? 0);
            // Inventories report.
            $sheet->getCell('BI15')->setValue($fsinputs['Inventories']['Year1'] ?? 0);
            $sheet->getCell('BO15')->setValue($fsinputs['Inventories']['Year2'] ?? 0);
            $sheet->getCell('BU15')->setValue($fsinputs['Inventories']['Year3'] ?? 0);
            // Other CA report.
            $sheet->getCell('BI16')->setValue($fsinputs['Other CA']['Year1'] ?? 0);
            $sheet->getCell('BO16')->setValue($fsinputs['Other CA']['Year2'] ?? 0);
            $sheet->getCell('BU16')->setValue($fsinputs['Other CA']['Year3'] ?? 0);
            // Fixed Assets report.
            $sheet->getCell('BI17')->setValue($fsinputs['Fixed Assets']['Year1'] ?? 0);
            $sheet->getCell('BO17')->setValue($fsinputs['Fixed Assets']['Year2'] ?? 0);
            $sheet->getCell('BU17')->setValue($fsinputs['Fixed Assets']['Year3'] ?? 0);
            // Trade Payables report.
            $sheet->getCell('BI20')->setValue($fsinputs['Trade Payables']['Year1'] ?? 0);
            $sheet->getCell('BO20')->setValue($fsinputs['Trade Payables']['Year2'] ?? 0);
            $sheet->getCell('BU20')->setValue($fsinputs['Trade Payables']['Year3'] ?? 0);
            // Other CL report.
            $sheet->getCell('BI21')->setValue($fsinputs['Other CL']['Year1'] ?? 0);
            $sheet->getCell('BO21')->setValue($fsinputs['Other CL']['Year2'] ?? 0);
            $sheet->getCell('BU21')->setValue($fsinputs['Other CL']['Year3'] ?? 0);
            // Stockholders' Equity report.
            $sheet->getCell('BI23')->setValue($fsinputs["Stockholders' Equity"]['Year1'] ?? 0);
            $sheet->getCell('BO23')->setValue($fsinputs["Stockholders' Equity"]['Year2'] ?? 0);
            $sheet->getCell('BU23')->setValue($fsinputs["Stockholders' Equity"]['Year3'] ?? 0);
            // Other NCL report.
            $sheet->getCell('BI24')->setValue($fsinputs['Other NCL']['Year1'] ?? 0);
            $sheet->getCell('BO24')->setValue($fsinputs['Other NCL']['Year2'] ?? 0);
            $sheet->getCell('BU24')->setValue($fsinputs['Other NCL']['Year3'] ?? 0);
            // Common Shares Outstanding report.
            $sheet->getCell('BI25')->setValue($fsinputs['Common Shares Outstanding']['Year1'] ?? 0);
            $sheet->getCell('BO25')->setValue($fsinputs['Common Shares Outstanding']['Year2'] ?? 0);
            $sheet->getCell('BU25')->setValue($fsinputs['Common Shares Outstanding']['Year3'] ?? 0);
        }//end if

        // Load Financial Statement Quantitative Assessment 2.
        $sheet = $spreadsheet->getSheetByName('PD2_inputs');
        $fsinputs = $customer->metadata['fps-qa2'] ?? [];
        // Profit or (Loss) Before Income Tax report.
        $sheet->getCell('AC11')->setValue($fsinputs['Profit or (Loss) Before Income Tax']['Year1'] ?? 0);
        $sheet->getCell('AI11')->setValue($fsinputs['Profit or (Loss) Before Income Tax']['Year2'] ?? 0);
        $sheet->getCell('AO11')->setValue($fsinputs['Profit or (Loss) Before Income Tax']['Year3'] ?? 0);
        // Profit from Fixed Assets Sale report.
        $sheet->getCell('AC13')->setValue($fsinputs['Profit from Fixed Assets Sale']['Year1'] ?? 0);
        $sheet->getCell('AI13')->setValue($fsinputs['Profit from Fixed Assets Sale']['Year2'] ?? 0);
        $sheet->getCell('AO13')->setValue($fsinputs['Profit from Fixed Assets Sale']['Year3'] ?? 0);
        // Profit from Foreign Exchange report.
        $sheet->getCell('AC14')->setValue($fsinputs['Profit from Foreign Exchange']['Year1'] ?? 0);
        $sheet->getCell('AI14')->setValue($fsinputs['Profit from Foreign Exchange']['Year2'] ?? 0);
        $sheet->getCell('AO14')->setValue($fsinputs['Profit from Foreign Exchange']['Year3'] ?? 0);
        // Other Income report.
        $sheet->getCell('AC15')->setValue($fsinputs['Other Income']['Year1'] ?? 0);
        $sheet->getCell('AI15')->setValue($fsinputs['Other Income']['Year2'] ?? 0);
        $sheet->getCell('AO15')->setValue($fsinputs['Other Income']['Year3'] ?? 0);
        // Bad Debts report.
        $sheet->getCell('AC17')->setValue($fsinputs['Bad Debts']['Year1'] ?? 0);
        $sheet->getCell('AI17')->setValue($fsinputs['Bad Debts']['Year2'] ?? 0);
        $sheet->getCell('AO17')->setValue($fsinputs['Bad Debts']['Year3'] ?? 0);
        // Donations report.
        $sheet->getCell('AC18')->setValue($fsinputs['Donations']['Year1'] ?? 0);
        $sheet->getCell('AI18')->setValue($fsinputs['Donations']['Year2'] ?? 0);
        $sheet->getCell('AO18')->setValue($fsinputs['Donations']['Year3'] ?? 0);
        // Foreign Exchange Loss report.
        $sheet->getCell('AC19')->setValue($fsinputs['Foreign Exchange Loss']['Year1'] ?? 0);
        $sheet->getCell('AI19')->setValue($fsinputs['Foreign Exchange Loss']['Year2'] ?? 0);
        $sheet->getCell('AO19')->setValue($fsinputs['Foreign Exchange Loss']['Year3'] ?? 0);
        // Loss on Fixed Assets Sale report.
        $sheet->getCell('AC20')->setValue($fsinputs['Loss on Fixed Assets Sale']['Year1'] ?? 0);
        $sheet->getCell('AI20')->setValue($fsinputs['Loss on Fixed Assets Sale']['Year2'] ?? 0);
        $sheet->getCell('AO20')->setValue($fsinputs['Loss on Fixed Assets Sale']['Year3'] ?? 0);
        // Others (Non-Operating Costs) report.
        $sheet->getCell('AC21')->setValue($fsinputs['Others (Non-Operating Costs)']['Year1'] ?? 0);
        $sheet->getCell('AI21')->setValue($fsinputs['Others (Non-Operating Costs)']['Year2'] ?? 0);
        $sheet->getCell('AO21')->setValue($fsinputs['Others (Non-Operating Costs)']['Year3'] ?? 0);
        // Employee Compensation report.
        $sheet->getCell('AC25')->setValue($fsinputs['Employee Compensation']['Year1'] ?? 0);
        $sheet->getCell('AI25')->setValue($fsinputs['Employee Compensation']['Year2'] ?? 0);
        $sheet->getCell('AO25')->setValue($fsinputs['Employee Compensation']['Year3'] ?? 0);
        // Bonuses report.
        $sheet->getCell('AC26')->setValue($fsinputs['Bonuses']['Year1'] ?? 0);
        $sheet->getCell('AI26')->setValue($fsinputs['Bonuses']['Year2'] ?? 0);
        $sheet->getCell('AO26')->setValue($fsinputs['Bonuses']['Year3'] ?? 0);
        // Provident Fund report.
        $sheet->getCell('AC27')->setValue($fsinputs['Provident Fund']['Year1'] ?? 0);
        $sheet->getCell('AI27')->setValue($fsinputs['Provident Fund']['Year2'] ?? 0);
        $sheet->getCell('AO27')->setValue($fsinputs['Provident Fund']['Year3'] ?? 0);
        // Employee Welfare report.
        $sheet->getCell('AC28')->setValue($fsinputs['Employee Welfare']['Year1'] ?? 0);
        $sheet->getCell('AI28')->setValue($fsinputs['Employee Welfare']['Year2'] ?? 0);
        $sheet->getCell('AO28')->setValue($fsinputs['Employee Welfare']['Year3'] ?? 0);
        // Medical Costs report.
        $sheet->getCell('AC29')->setValue($fsinputs['Medical Costs']['Year1'] ?? 0);
        $sheet->getCell('AI29')->setValue($fsinputs['Medical Costs']['Year2'] ?? 0);
        $sheet->getCell('AO29')->setValue($fsinputs['Medical Costs']['Year3'] ?? 0);
        // Employee Training report.
        $sheet->getCell('AC30')->setValue($fsinputs['Employee Training']['Year1'] ?? 0);
        $sheet->getCell('AI30')->setValue($fsinputs['Employee Training']['Year2'] ?? 0);
        $sheet->getCell('AO30')->setValue($fsinputs['Employee Training']['Year3'] ?? 0);
        // Director\'s Salary report.
        $sheet->getCell('AC31')->setValue($fsinputs['Director\'s Salary']['Year1'] ?? 0);
        $sheet->getCell('AI31')->setValue($fsinputs['Director\'s Salary']['Year2'] ?? 0);
        $sheet->getCell('AO31')->setValue($fsinputs['Director\'s Salary']['Year3'] ?? 0);
        // Employee Insurance report.
        $sheet->getCell('AC32')->setValue($fsinputs['Employee Insurance']['Year1'] ?? 0);
        $sheet->getCell('AI32')->setValue($fsinputs['Employee Insurance']['Year2'] ?? 0);
        $sheet->getCell('AO32')->setValue($fsinputs['Employee Insurance']['Year3'] ?? 0);
        // Others (Labour Expenses) report.
        $sheet->getCell('AC33')->setValue($fsinputs['Others (Labour Expenses)']['Year1'] ?? 0);
        $sheet->getCell('AI33')->setValue($fsinputs['Others (Labour Expenses)']['Year2'] ?? 0);
        $sheet->getCell('AO33')->setValue($fsinputs['Others (Labour Expenses)']['Year3'] ?? 0);
        // Interest & Charges by Bank report.
        $sheet->getCell('AC37')->setValue($fsinputs['Interest & Charges by Bank']['Year1'] ?? 0);
        $sheet->getCell('AI37')->setValue($fsinputs['Interest & Charges by Bank']['Year2'] ?? 0);
        $sheet->getCell('AO37')->setValue($fsinputs['Interest & Charges by Bank']['Year3'] ?? 0);
        // Interest on Loan report.
        $sheet->getCell('AC38')->setValue($fsinputs['Interest on Loan']['Year1'] ?? 0);
        $sheet->getCell('AI38')->setValue($fsinputs['Interest on Loan']['Year2'] ?? 0);
        $sheet->getCell('AO38')->setValue($fsinputs['Interest on Loan']['Year3'] ?? 0);
        // Interest on Hire Purchase report.
        $sheet->getCell('AC39')->setValue($fsinputs['Interest on Hire Purchase']['Year1'] ?? 0);
        $sheet->getCell('AI39')->setValue($fsinputs['Interest on Hire Purchase']['Year2'] ?? 0);
        $sheet->getCell('AO39')->setValue($fsinputs['Interest on Hire Purchase']['Year3'] ?? 0);
        // Others (interest on loan/hires) report.
        $sheet->getCell('AC40')->setValue($fsinputs['Others (interest on loan/hires)']['Year1'] ?? 0);
        $sheet->getCell('AI40')->setValue($fsinputs['Others (interest on loan/hires)']['Year2'] ?? 0);
        $sheet->getCell('AO40')->setValue($fsinputs['Others (interest on loan/hires)']['Year3'] ?? 0);
        // Buildings report.
        $sheet->getCell('AC44')->setValue($fsinputs['Interest on Hire Purchase']['Year1'] ?? 0);
        $sheet->getCell('AI44')->setValue($fsinputs['Interest on Hire Purchase']['Year2'] ?? 0);
        $sheet->getCell('AO44')->setValue($fsinputs['Interest on Hire Purchase']['Year3'] ?? 0);
        // Plant, Machinery & Equipment report.
        $sheet->getCell('AC45')->setValue($fsinputs['Plant, Machinery & Equipment']['Year1'] ?? 0);
        $sheet->getCell('AI45')->setValue($fsinputs['Plant, Machinery & Equipment']['Year2'] ?? 0);
        $sheet->getCell('AO45')->setValue($fsinputs['Plant, Machinery & Equipment']['Year3'] ?? 0);
        // Others report.
        $sheet->getCell('AC46')->setValue($fsinputs['Others']['Year1'] ?? 0);
        $sheet->getCell('AI46')->setValue($fsinputs['Others']['Year2'] ?? 0);
        $sheet->getCell('AO46')->setValue($fsinputs['Others']['Year3'] ?? 0);
        // Tax on Property report.
        $sheet->getCell('AC50')->setValue($fsinputs['Tax on Property']['Year1'] ?? 0);
        $sheet->getCell('AI50')->setValue($fsinputs['Tax on Property']['Year2'] ?? 0);
        $sheet->getCell('AO50')->setValue($fsinputs['Tax on Property']['Year3'] ?? 0);
        // Duties (Customs & Excise) report.
        $sheet->getCell('AC51')->setValue($fsinputs['Duties (Customs & Excise)']['Year1'] ?? 0);
        $sheet->getCell('AI51')->setValue($fsinputs['Duties (Customs & Excise)']['Year2'] ?? 0);
        $sheet->getCell('AO51')->setValue($fsinputs['Duties (Customs & Excise)']['Year3'] ?? 0);
        // Levy on Foreign Workers report.
        $sheet->getCell('AC52')->setValue($fsinputs['Levy on Foreign Workers']['Year1'] ?? 0);
        $sheet->getCell('AI52')->setValue($fsinputs['Levy on Foreign Workers']['Year2'] ?? 0);
        $sheet->getCell('AO52')->setValue($fsinputs['Levy on Foreign Workers']['Year3'] ?? 0);
        // Others (excluding Income Tax & GST/VAT) report.
        $sheet->getCell('AC53')->setValue($fsinputs['Others (excluding Income Tax & GST/VAT)']['Year1'] ?? 0);
        $sheet->getCell('AI53')->setValue($fsinputs['Others (excluding Income Tax & GST/VAT)']['Year2'] ?? 0);
        $sheet->getCell('AO53')->setValue($fsinputs['Others (excluding Income Tax & GST/VAT)']['Year3'] ?? 0);

        return $spreadsheet;
    }
}
