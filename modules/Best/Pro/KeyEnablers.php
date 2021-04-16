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

        $talent = self::map($reports, 'Talent');

        $technology = self::map($reports, 'Technology');

        $workflow = self::map($reports, 'Workflow Processes');

        $documentationValue = self::getValue($code, $documentation, 'Documentation');

        $talentValue = self::getValue($code, $talent, 'Talent');

        $talentValue = self::getValue($code, $workflow, 'Technology');

        $workflowValue = self::getValue($code, $technology, 'Workflow Processes');

        $documentationComment = '';
        $documentationSubscore = $documentation->sortBy('metadata.subscore')->take(3)->values();
        if (($documentationValue/100) > config('modules.best.scores.grades.red')) {
            if (($documentationValue/100) > config('modules.best.scores.grades.amber')) {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? 'greaterThan90' : '50to90';
                $documentationComment = trans("best::enablers/$code.documentation.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($documentationSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($documentationSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($documentationSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? '50to90' : '30to50';
                $documentationComment = trans("best::enablers/$code.documentation.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($documentationSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($documentationSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($documentationSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        } else {
            if (($documentationValue/100) < config('modules.best.scores.grades.nonlight')) {
                $documentationComment = trans("best::enablers/$code.documentation.less30", [
                    'name' => $customer ?? null,
                    'item1' => __($documentationSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($documentationSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($documentationSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $documentationComment = trans("best::enablers/$code.documentation.30to50", [
                    'name' => $customer ?? null,
                    'item1' => __($documentationSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($documentationSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($documentationSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        }//end if

        $talentComment = '';
        $talentSubscore = $talent->sortBy('metadata.subscore')->take(3)->values();
        if (($talentValue/100) > config('modules.best.scores.grades.red')) {
            if (($talentValue/100) > config('modules.best.scores.grades.amber')) {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? 'greaterThan90' : '50to90';
                $talentComment = trans("best::enablers/$code.talent.$commentValue", [
                    'name' => $customer,
                    'item1' => __($talentSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($talentSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($talentSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? '50to90' : '30to50';
                $talentComment = trans("best::enablers/$code.talent.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($talentSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($talentSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($talentSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        } else {
            if (($talentValue/100) < config('modules.best.scores.grades.nonlight')) {
                $talentComment = trans("best::enablers/$code.talent.less30", [
                    'name' => $customer,
                    'item1' => __($talentSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($talentSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($talentSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $talentComment = trans("best::enablers/$code.talent.30to50", [
                    'name' => $customer ?? null,
                    'item1' => __($talentSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($talentSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($talentSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        }//end if

        $technologyComment = '';
        $technologySubscore = $technology->sortBy('metadata.subscore')->take(3)->values();
        if (($technologyValue/100) > config('modules.best.scores.grades.red')) {
            if (($technologyValue/100) > config('modules.best.scores.grades.amber')) {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? 'greaterThan90' : '50to90';
                $technologyComment = trans("best::enablers/$code.technology.$commentValue", [
                    'name' => $customer,
                    'item1' => __($technologySubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($technologySubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($technologySubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? '50to90' : '30to50';
                $technologyComment = trans("best::enablers/$code.technology.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($technologySubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($technologySubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($technologySubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        } else {
            if (($technologyValue/100) < config('modules.best.scores.grades.nonlight')) {
                $technologyComment = trans("best::enablers/$code.technology.less30", [
                    'name' => $customer ?? null,
                    'item1' => __($technologySubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($technologySubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($technologySubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $technologyComment = trans("best::enablers/$code.technology.30to50", [
                    'name' => $customer ?? null,
                    'item1' => __($technologySubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($technologySubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($technologySubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        }//end if

        $workflowComment = '';
        $workflowSubscore = $workflow->sortBy('metadata.subscore')->take(3)->values();
        if (($workflowValue/100) > config('modules.best.scores.grades.red')) {
            if (($workflowValue/100) > config('modules.best.scores.grades.amber')) {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? 'greaterThan90' : '50to90';
                $workflowComment = trans("best::enablers/$code.workflow.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($workflowSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($workflowSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($workflowSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $hasGreaterThan90 = config("modules.best.scores.has_greaterThan90_value.$code");
                $commentValue = $hasGreaterThan90 ? '50to90' : '30to50';
                $workflowComment = trans("best::enablers/$code.workflow.$commentValue", [
                    'name' => $customer ?? null,
                    'item1' => __($workflowSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($workflowSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($workflowSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        } else {
            if (($workflowValue/100) < config('modules.best.scores.grades.nonlight')) {
                $workflowComment = trans("best::enablers/$code.workflow.less30", [
                    'name' => $customer ?? null,
                    'item1' => __($workflowSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($workflowSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($workflowSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            } else {
                $workflowComment = trans("best::enablers/$code.workflow.30to50", [
                    'name' => $customer ?? null,
                    'item1' => __($workflowSubscore->get(0)->submissible->metadata['comment'] ?? null),
                    'item2' => __($workflowSubscore->get(1)->submissible->metadata['comment'] ?? null),
                    'item3' => __($workflowSubscore->get(2)->submissible->metadata['comment'] ?? null),
                ]);
            }
        }//end if

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


    protected static function documentationValue($code, $index, $key)
    {
        $keyScoreValue = config("modules.best.scores.key_enablers_score.{$code}.{$key}");
        return round((($index->sum('results')/($index->count() ?: 1))/$keyScoreValue) * 100);
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
