<?php

namespace Best\Pro\Financial\Contracts;

interface FinancialAnalysisReportInterface
{
    /**
     * Generate the report.
     *
     * @return array
     */
    public static function getReport();
}
