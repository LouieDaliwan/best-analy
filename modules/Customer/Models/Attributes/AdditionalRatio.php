<?php

namespace Customer\Models\Attributes;


class AdditionalRatio {
    
    public static function compute($additionalRatio, $customer, $statements) 
    {
        $statements = $statements['metadataStatements'];

        $investmentValue = (int) $customer->detail->metadata['investment_value'];

        $additionalRatio['raw_materials_margin'] = (float) $statements['Sales'] != 0 ? round(((float) $statements['Raw Materials'] / (float) $statements['Sales']), 2) : 0;

        $additionalRatio['roi'] = $investmentValue != (null || 0) ? round(($statements['Net Operating Profit/(Loss)'] / $investmentValue), 2) : 0;

        return $additionalRatio;
    }

}