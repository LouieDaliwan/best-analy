<?php

namespace Best\Services;

use Best\Services\FormulaFinancialRatioInterface;
use User\Models\User;
use Carbon\Carbon;
use Core\Application\Service\Service;
use Best\Pro\Financial\EfficiencyAnalysis;
use Best\Pro\Financial\FinancialRatios;
use Best\Pro\Financial\LiquidityAnalysis;
use Best\Pro\Financial\ProductivityAnalysis;
use Best\Pro\Financial\ProductivityIndicators;
use Best\Pro\Financial\ProfitabilityAnalysis;
use Best\Pro\Financial\SolvencyAnalysis;
use Customer\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Setting\Models\Setting;
use Spatie\Browsershot\Browsershot;


class FormulaFinancialRatioService extends Service implements FormulaFinancialRatioInterface
{

    /**
     * The property on Customer class instances
     * @param Customer\Models\Customer $customer
     */
    public $customer;

     /**
      * Constructor to bind model to a repository.
      *
      * @param \Best\Models\Customer     $model
      */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

     /**
      * Generate the financial report.
      *
      * @param  \Customer\Models\Customer $customer
      * @param  \User\Models\User         $user
      * @return array
      */
    public function generateRatio(Customer $customer, User $user)
    {
        return [
            //customer
            'customer:name' => $customer->name,
            'customer:refnum' => $customer->refnum,
            'customer:industry' => $customer->metadata['industry'] ?? null,
            'customer:counselor' => $customer->metadata['BusinessCounselorName'] ?? null,
            'customer:staffstrength' => $customer->metadata['staffstrength'] ?? null,
            'customer:type' => $customer->metadata['type'] ?? null,
            'cover:date' => date(settings('formal:date', 'Y-m-d')),
            'month:formatted' => date('M Y'),

            //analysis
            'analysis:financial' => $this->getFinancialAnalysisData($customer),

            //organisation
            'organisation:profile' => $customer->toArray(),

            //user
            'report:user' => $user->displayname,

            //ratios
            'ratios:financial' => $this->getFinancialRatios($customer),
            'indicators:productivity' => $this->getProductivityIndicators($customer),

        ];
    }

    /**
     * Retrieve the Financial Analysis data.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getFinancialAnalysisData(Customer $customer)
    {
        return [
            'profitability' => ProfitabilityAnalysis::getReport($customer),
            'liquidity' => LiquidityAnalysis::getReport($customer),
            'efficiency' => EfficiencyAnalysis::getReport($customer),
            'solvency' => SolvencyAnalysis::getReport($customer),
            'productivity' => ProductivityAnalysis::getReport($customer),
        ];
    }

    /**
     * Retrieve the Financial Ratios array.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getFinancialRatios(Customer $customer)
    {
        return FinancialRatios::getReport($customer);
    }

    /**
     * Retrieve the productivity indicators.
     *
     * @param  \Customer\Models\Customer $customer
     * @return array
     */
    public function getProductivityIndicators($customer)
    {
        return ProductivityIndicators::getReportWithCustomer($customer);
    }
}
