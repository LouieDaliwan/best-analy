<?php

namespace Best\Pro;

class KeyEnablers
{
    /**
     * Retrieve the Key Enablers array.
     *
     * @param  Illuminate\Support\Collection $reports
     * @param  string                        $customer
     * @param  string                        $code
     * @return array
     */

    public static function get($reports, $customer, $code)
    {
        return self::evaluateIndexes($reports, $customer, strtolower($code));
    }

    /**
    * Evaluate overall result for key enablers
    * @param  Illuminate\Support\Collection $reports
    * @param  string                        $customer
    * @param  string                        $code
    * @return arr
    */
    protected static function evaluateIndexes($reports, $customer, $code)
    {
        $indexes = ['Documentation', 'Talent', 'Technology', 'Workflow Processes'];

        $arr = [];

        foreach ($indexes as $index) {
            $temp_str = $index == 'Workflow Processes' ? substr($index, 0, 8) : $index;

            $indexMap = self::map($reports, $index);

            $indexValue = self::getValue($code, $indexMap, $index);

            $arr['chart']['labels'][] = __($index);

            isset($arr['data'][$index]) ? : $arr['data'][$index] = [
                'value' => $indexValue,
                'comment'=> self::getComment($indexMap, $indexValue, strtolower($temp_str), $code, $customer),
            ];
        }

        $arr['chart']['dataset'] = $arr['data'];

        return $arr;
    }

    /**
    *  Trace the with average
    * @param  Illuminate\Support\Collection $reports
    * @param  string                        $index
    * @return arr
    */
    protected static function map($reports, $index)
    {
        return $reports->map(function ($report) use($index) {
            return $report->reportable;
        })->filter(function ($submission) use ($index) {
            return ($submission->submissible->metadata['category'][$index] ?? false)
                && $submission->submissible->metadata['category'][$index] == 'Y';
        })->reject(function ($submission) {
            return (float) $submission->metadata['average'] == 0.00;
        });
    }

    /**
    * Get the value via index
    * @param  string $code
    * @param  string $index
    * @param  string key
    * @return string
    */
    protected static function getValue($code, $index, $key)
    {
        $keyScoreValue = config("modules.best.scores.key_enablers_score.{$code}.{$key}");

        if($index->isNotEmpty()) {
            return round((($index->sum('results')/($index->count() ?: 1))/$keyScoreValue) * 100);
        }

        return 0;
    }

     /**
    * Get the comment via index
    * @param  Illuminate\Support\Collection $indexObject
    * @param  int $indexValue
    * @param  string $index
    * @param  string $code
    * @param  string $customer
    * @return int
    */
    protected static function getComment($indexObject, $indexValue, $index, $code, $customer)
    {
        if ($indexValue == 0) return self::getNAComment($index);

        $indexSubscore = $indexObject->sortBy('metadata.subscore')->take(3)->values();
        $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");

       if (($indexValue/100) > config('modules.best.scores.grades.red')) {
            if (($indexValue/100) > config('modules.best.scores.grades.amber')) {
                $commentValue = $hasGreaterThan90 ? 'greaterThan90' : '50to90';
            } else {
                $commentValue = $hasGreaterThan90 ? '50to90' : '30to50';
            }
        } else {
            $commentValue = ($indexValue/100) < config('modules.best.scores.grades.nonlight') ? "less30" : "30to50";
        }

        return self::layoutComment($indexSubscore, $index, $commentValue, $code, $customer);
    }

    protected static function layoutComment($indexSubscore, $index,$commentValue, $code, $customer)
    {
        return trans("best::enablers/$code.$index.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($indexSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($indexSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($indexSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]
        );
    }

    protected static function getNAComment($index) {
        switch ($index) {
            case 'documentation':
                return 'It is critical to document matters as a basic practice.';
            case 'talent':
                return 'Do explore how you can work with a Team to improve efficiency.';
            case 'technology':
                return 'Adopting Useful Technology will greatly improve your business efficiency.';
            case 'workflow':
                return 'Implementing clear work processes can improve consistency in operations.';
            default:
                return '';
        }
    }

    /**
     * Retrieve comment via keyword.
     *
     * @param  string code
     * @param  string month
     * @param  Illuminate\Support\Collection fields
     * @return string
     */
    public static function getDescription($code, $month, $fields)
    {
        $code = strtolower($code);
        $comment = '';

        switch ($code) {
            case 'fmpi':
                $comment = trans("best::enablers/fmpi.description");
                break;

            case 'bspi':
                $comment = trans("best::enablers/bspi.description");
                break;

            case 'hrpi':
                $comment = trans("best::enablers/hrpi.description");
                break;

            case 'pmpi':
                $comment = trans("best::enablers/pmpi.description");
                break;
        }

        return $comment;
    }

}
