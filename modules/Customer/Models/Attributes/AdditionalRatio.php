<?php

namespace Customer\Models\Attributes;


class AdditionalRatio {
    
    public static function compute($additionalRatio, $customer, $statements) 
    {
        $statements = $statements['metadataStatements'];

        $investmentValue = (int) $customer->detail->metadata['investment_value'];

        $additionalRatio['raw_materials_margin'] = (float) $statements['Sales'] != 0 ? divide((float) $statements['Raw Materials'], (float) $statements['Sales']) : 0;

        $additionalRatio['roi'] = $investmentValue != (null || 0) ? divide($statements['Net Operating Profit/(Loss)'], $investmentValue) : 0;

        return $additionalRatio;
    }

}