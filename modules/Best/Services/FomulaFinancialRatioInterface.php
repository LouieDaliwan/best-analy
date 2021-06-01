<?php

namespace Best\Services;

use Core\Application\Service\ServiceInterface;

interface FormulaFinancialRatioInterface extends ServiceInterface
{
    public function generateRatio();
}
