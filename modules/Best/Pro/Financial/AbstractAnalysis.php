<?php

namespace Best\Pro\Financial;

use PhpOffice\PhpSpreadsheet\Chart\Renderer\JpGraph;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Settings;

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
     * @return array
     */
    abstract public static function getReport();

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
     * @return \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Workbook
     */
    public static function getSpreadsheet()
    {
        $newFile = self::$filePath = self::getSpreadsheetFile(date('YmdHis').rand());
        copy(self::getSpreadsheetFile(), $newFile);

        Settings::setChartRenderer(JpGraph::class);
        $reader = new XlsxReader();
        $reader->setIncludeCharts(true);
        $spreadsheet = $reader->load($newFile);

        self::unlinkFile();

        return $spreadsheet;
    }
}
