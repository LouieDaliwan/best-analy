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

                    if ($ratio['score'] >= $remarkPoint1 && $score <= $remarkPoint2) {
                        $remarks = $remark;
                        $ratioAnalysis['dashboard'][$ratioKey]['remarks'] = $remarks;
                    }

                    if ($remark == 'Very Poor' && $score < $remarkPoint1) {                       
                        $remarks = 'Very Poor';
                        $ratioAnalysis['dashboard'][$ratioKey]['remarks'] = $remarks;
                    }

                    if ($score >= $remarkPoint1 && $remarkPoint2 == 0) {
                        $remarks = $remark;
                        $ratioAnalysis['dashboard'][$ratioKey]['remarks'] = $remarks;
                    }

                    $ratioAnalysis['dashboard'][$ratioKey]['color'] = self::colorStatus($remarks);           
                }
            }
        }
        
        return $ratioAnalysis['dashboard'];
    }



    protected static function coLorStatus($remark)
    {
        switch ($remark) {
            case "Very Poor" :
                $color = '#F20000';
                break;
            case "Poor":
                $color = '#F9BE00';
                break;
            case "Moderate":
                $color = '#8A2B91';
                break;
            case "Good":
                $color = '#9BCF44';
                break;
            case "Excellent":
                $color = '#40AF49';
                break;
            default:
                $color = '#F20000';
        }

        return $color;
    }
}