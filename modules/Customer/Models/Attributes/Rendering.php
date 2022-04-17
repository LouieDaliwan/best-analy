<?php

namespace Customer\Models\Attributes;

class Rendering
{
    public static function results($ratioAnalysis, $statements, $customer)
    {
        $period = $statements['metadataStatements']['period'];
        $projectType = $customer->detail->metadata['project_type'];

        $ratioAnalysis['dashboard']['date'] = $period;
        $ratioAnalysis['dashboard']['project_type'] = $projectType;

        $projectType = strtolower(
            str_replace(" ", "_", $customer->detail->metadata['project_type'])
        );

        if ($projectType !=  "") {

            $projectTypeValues = config("fratio.{$projectType}");

            foreach ($projectTypeValues as $ratioKey => $ratioValue) {

                $ratio = $ratioAnalysis['dashboard'][$ratioKey];

                foreach ($ratioValue as $remark => $remarkPoints) {
                    $remarks = '';
                    
                    $remarkPoint1 = (float) $remarkPoints[0];
                    $remarkPoint2 = (float) isset($remarkPoints[1]) ? $remarkPoints[1] : 0;

                    $score = round((float) $ratio['score'], 2); 
                                    
                    if ($score >= $remarkPoint1 && $score <= $remarkPoint2) {
                        
                        $remarks = $remark;
                        $ratioAnalysis['dashboard'][$ratioKey]['color'] = self::colorStatus($remarks);
                        $ratioAnalysis['dashboard'][$ratioKey]['remarks'] = $remarks;
                    }

                    if ($remark == 'Very Poor' && $score < $remarkPoint1 && collect(['raw_materials', 'debt_ratio'])->intersect([$ratioKey])->isEmpty()) {                       
                        $remarks = 'Very Poor';
                        $ratioAnalysis['dashboard'][$ratioKey]['remarks'] = $remarks;
                    }

                    if ($score >= $remarkPoint1 && $remarkPoint2 == 0 && collect(['raw_materials', 'debt_ratio'])->intersect([$ratioKey])->isEmpty()) {
                        $remarks = $remark;
                        $ratioAnalysis['dashboard'][$ratioKey]['color'] = self::colorStatus($remarks);
                        $ratioAnalysis['dashboard'][$ratioKey]['remarks'] = $remarks;
                    }
                    
                    if ($score <= $remarkPoint1 && $remark == 'Excellent' && collect(['raw_materials', 'debt_ratio'])->intersect([$ratioKey])->isNotEmpty()) {
                        $remarks = $remark;
                        $ratioAnalysis['dashboard'][$ratioKey]['color'] = self::colorStatus($remarks);
                        $ratioAnalysis['dashboard'][$ratioKey]['remarks'] = $remarks; 
                    }
                }
            }
        }

        $ratioAnalysis['dashboard']['financial_score'] = self::computeFinancialScore($ratioAnalysis['dashboard']);
        
        
        return $ratioAnalysis['dashboard'];
    }

    protected static function computeFinancialScore($dashboard)
    {
        $financial_score = 0.00;

        $score_descriptor = config('fratio')['score_descriptor'];

        foreach ($dashboard as $key => $value) {
            
            if(!is_array($value)){
                continue;
            }

            $rating = (float) ($value['score'] * $score_descriptor[$value['remarks']]);

            $financial_score += $rating;
        }
       
        return $financial_score;
    }



    protected static function coLorStatus($remark)
    {
        switch ($remark) {
            case "Very Poor" :
                return '#F20000';
                break;
            case "Poor":
                return '#F9BE00';
                break;
            case "Moderate":
                return '#8A2B91';
                break;
            case "Good":
                return '#9BCF44';
                break;
            case "Excellent":
                return '#40AF49';
                break;
            default:
                return '#F20000';
        }
    }
}