<?php

namespace Best\Pro;
use Illuminate\Support\Str;

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
        $code = strtolower($code);

        $documentation = self::map($reports, 'Documentation');
        $documentationValue = self::getValue($code, $documentation, 'Documentation');
        $documentationComment = self::getComment($documentation, $documentationValue, 'documentation', $code, $customer);

        $talent = self::map($reports, 'Talent');
        $talentValue = self::getValue($code, $talent, 'Talent');
        $talentComment = self::getComment($talent, $talentValue, 'talent', $code, $customer);

        $technology = self::map($reports, 'Technology');
        $technologyValue = self::getValue($code, $technology, 'Technology');
        $technologyComment = self::getComment($technology, $technologyValue, 'technology', $code, $customer);

        $workflow = self::map($reports, 'Workflow Processes');
        $workflowValue = self::getValue($code, $workflow, 'Workflow Processes');
        $workflowComment = self::getComment($workflow, $workflowValue, 'workflow', $code, $customer);

        return [
            'chart' => [
                'labels' => [__('Documentation'), __('Talent'), __('Technology'), __('Workflow Processes')],
                'dataset' => [$documentationValue, $talentValue, $technologyValue, $workflowValue],
            ],
            'data' => [
                'Documentation' => [
                    'value' => $documentationValue,
                    'comment' => $documentationComment,
                ],
                'Talent' => [
                    'value' => $talentValue,
                    'comment' => $talentComment,
                ],
                'Technology' => [
                    'value' => $technologyValue,
                    'comment' => $technologyComment,
                ],
                'Workflow Processes' => [
                    'value' => $workflowValue,
                    'comment' => $workflowComment,
                ],
            ],
        ];
    }

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


    protected static function getValue($code, $index, $key)
    {
        $keyScoreValue = config("modules.best.scores.key_enablers_score.{$code}.{$key}");
        return round((($index->sum('results')/($index->count() ?: 1))/$keyScoreValue) * 100);
    }

    protected static function getComment($indexObject, $indexValue, $index, $code, $customer)
    {
        $indexComment = '';
        $indexSubscore = $indexObject->sortBy('metadata.subscore')->take(3)->values();
        if (($indexValue/100) > config('modules.best.scores.grades.red')) {
            if (($indexValue/100) > config('modules.best.scores.grades.amber')) {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? 'greaterThan90' : '50to90';
                $indexComment = trans("best::enablers/$code.$index.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($indexSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($indexSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($indexSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? '50to90' : '30to50';
                $indexComment = trans("best::enablers/$code.$index.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($indexSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($indexSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($indexSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        } else {
            if (($indexValue/100) < config('modules.best.scores.grades.nonlight')) {
                $indexComment = trans("best::enablers/$code.$index.less30", [
                    'name' => $customer ?? null,
                    'item1' => __($indexSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($indexSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($indexSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $indexComment = trans("best::enablers/$code.$index.30to50", [
                    'name' => $customer ?? null,
                    'item1' => __($indexSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($indexSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($indexSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        }

        return $indexComment;
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
