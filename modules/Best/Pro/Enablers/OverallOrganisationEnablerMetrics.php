<?php

namespace Best\Pro\Enablers;

/**
 * Overall organisation enabler metrics comment.
 *
 * @phpcs:disable
 */
abstract class OverallOrganisationEnablerMetrics
{
    const COMMENT_POINT_4_TOP = 0.4;
    const COMMENT_POINT_4_LEFT = 0.4;
    const COMMENT_POINT_8_LEFT = 0.8;
    const COMMENT_POINT_8_TOP = 0.8;

    const COMMENT2_POINT_4_PROCESS = 0.4;
    const COMMENT2_POINT_4_DOCU = 0.4;
    const COMMENT2_POINT_4_TALENT = 0.4;
    const COMMENT2_POINT_8_TALENT = 0.8;

    /**
     * Retrieve the first comment.
     *
     * @param  integer $techAvg
     * @param  integer $workflowAvg
     * @param  string  $name
     * @return string
     */
    public static function getFirstComment($techAvg, $workflowAvg, $name)
    {
        $comment[] =  null;

        if ($techAvg < self::COMMENT_POINT_4_TOP && $workflowAvg < self::COMMENT_POINT_4_LEFT) {
            $comment[] = __("Current 'Technology' adoption is not within desirable range.");
            $comment[] = __("This may have attributed to :name's perceived poor processes.", ['name' => $name]);
        } else {
            if ($workflowAvg < self::COMMENT_POINT_4_TOP && $techAvg > self::COMMENT_POINT_4_LEFT) {
                if ($techAvg > self::COMMENT_POINT_8_LEFT) {
                    $comment[] = __(":name is strongly advised to review non-technological enablers to ensure that the technology invested is well implementated across all work processes.", ['name' => $name]);
                } else {
                    $comment[] = __("While the technological adoption in :name is within acceptable range, an in-depth review of both the talent and documentation practices is recommended to ensure that the technology is optimised to meet the operational needs.", ['name' => $name]);
                }
            } else {
                if ($techAvg > self::COMMENT_POINT_8_LEFT && $workflowAvg > self::COMMENT_POINT_8_TOP) {
                    $comment[] = __("With a highly efficient workflow process supported by very good technology, any further technological investment will be expected to deliver a more significant value added improvements for :name's customers.", ['name' => $name]);
                } else {
                    if ($workflowAvg > self::COMMENT_POINT_8_TOP && $techAvg > self::COMMENT_POINT_4_TOP) {
                        if ($techAvg > self::COMMENT_POINT_8_LEFT) {
                            $comment[] = __(":name has demonstrated highly desirable technology integration within its workflow processes.", ['name' => $name]);
                            $comment[] = __("Periodic review of their non-technology enablers such as talent development can be looked into and tightened to ensure that the current high standards can be sustained.", ['name' => $name]);
                        } else {
                            $comment[] = __("Impressive workflow processes perceived despite the average technology adoption within :name. Organisation is advised to thread very carefully to ensure that any further technological enhancements will be meaningful and not disruptive to the current efficient processes.", ['name' => $name]);
                        }
                    } else {
                        if ($techAvg > self::COMMENT_POINT_8_LEFT && $workflowAvg > self::COMMENT_POINT_4_LEFT) {
                            if ($workflowAvg > self::COMMENT_POINT_8_TOP && $techAvg > self::COMMENT_POINT_8_LEFT) {
                                $comment[] = __(":name has demonstrated highly desirable technology integration within its workflow processes.", ['name' => $name]);
                                $comment[] = __("Periodic review of their non-technology enablers such as talent development can be looked into and tightened to ensure that the current high standards can be sustained.", ['name' => $name]);
                            } else {
                                $comment[] = __(":name's workflow processes has not been percieved to be highly efficient, despite the adoption of highly efficient technology solution(s).", ['name' => $name]);
                                $comment[] = __("A deep-dive into talent pool and documentation is recommended to review gaps that may exist.", ['name' => $name]);
                            }
                        } else {
                            if ($techAvg < self::COMMENT_POINT_4_TOP && $workflowAvg > sefl::COMMENT_POINT_4_LEFT) {
                                if ($workflowAvg > self::COMMENT_POINT_8_LEFT && $techAvg < self::COMMENT_POINT_8_TOP) {
                                    $comment[] = __("With a highly efficient workflow process supported by very good technology, any further technological investment will be expected to deliver a more significant value added improvements for :name's customers.", ['name' => $name]);
                                } else {
                                    $comment[] = __("The 'technology' component score seems to suggest a need for significant improvements which :name can work on for better efficiency.", ['name' => $name]);
                                    $comment[] = __("Given the presence of clear 'processes', better implementation of a more robust technology can help improve overall efficiency.", ['name' => $name]);
                                }
                            } else {
                                $comment[] = __(":name has shown positive adoption of technology into its work flow.", ['name' => $name]);
                                $comment[] = __("Significant improvements can still be achieved if the non-technology enablers, such as talent mix, are reviewed together to further enhance on the organisational efficiency.", ['name' => $name]);
                            }
                        }
                    }
                }
            }
        }

        return $comment;
    }

    /**
     * Retrieve the second comment.
     *
     * @param  integer $docuAvg
     * @param  integer $talentAvg
     * @param  integer $workflowAvg
     * @param  string  $name
     * @return string
     */
    public static function getSecondComment($docuAvg, $talentAvg, $workflowAvg, $name)
    {
        $comment = [];

        if ($workflowAvg < self::COMMENT2_POINT_4_PROCESS && $docuAvg < self::COMMENT2_POINT_4_DOCU && $talentAvg < self::COMMENT2_POINT_4_TALENT) {
            $comment[] = __("A thorough review of the 'documentation' practices and processes should be carried out while process gaps within the HR practices relating to 'talent' development are being conducted.");
        } else {
            if ($workflowAvg < self::COMMENT2_POINT_4_PROCESS && $docuAvg < self::COMMENT2_POINT_4_DOCU && $talentAvg > self::COMMENT2_POINT_4_TALENT) {
                if ($talentAvg > self::COMMENT2_POINT_8_TALENT) {
                    $comment[] = '';
                } else {
                    $comment[] = __("A thorough review of the 'documentation' practices and processes should be carried out while process gaps within the HR practices relating to 'talent' development are being conducted.");
                }
            } else {
                if ($workflowAvg < self::COMMENT2_POINT_4_PROCESS && $docuAvg < self::COMMENT2_POINT_4_DOCU && $talentAvg < self::COMMENT2_POINT_4_TALENT) {
                    $comment[] = '';
                } else {
                    $comment[] = __("Given that considerable 'documentation' and clear talent recruitment and development practices are already in place, periodic efficiency gaps review in these areas is still recommended.");
                    $comment[] = __("This is to ensure that complacency does not seep in to keep everyone in check.");
                }
            }
        }

        return $comment;
    }


    /**
     * Retrieve the workflow processes comment.
     *
     * @param  integer $workflowAvg
     * @param  string  $name
     * @return string
     */
    public static function getWorkflowProcessComment($workflowAvg, $name)
    {
        $comment = [];
        if ($workflowAvg < config('modules.best.scores.grades.red')) {
            if ($workflowAvg < config('modules.best.scores.grades.nonlight')) {
                $comment[] = __(":name should consider performing an in-depth review of all work processes across all organisational areas to ensure a sound work structure is set up. Growth will be slow if work structure does not evolve with the changing needs.", ['name' => $name]);
            } else {
                $comment[] = __("Organisation has shown some basic adoption of work processes. More can still be done to ensure that effective monitoring and governance of the expectations are practiced organisation-wide.");
            }
        } else {
            if ($workflowAvg > config('modules.best.scores.grades.amber')) {
                $comment[] = __("Overall, :name has indicated very good adoption of effective and efficient workflow processes that are well practiced. Such practices and culture should continue to be encouraged to maintain organisational efficiency.", ['name' => $name]);
            } else {
                $comment[] = __("Overall, :name's workflow processes have met the minimum expectations.", ['name' => $name]);
            }
        }

        return $comment;
    }

    /**
     * Retrieve the talent comment.
     *
     * @param  integer $talentAvg
     * @return string
     */
    public static function getTalentComment($talentAvg)
    {
        $comment = [];

        if ($talentAvg < config('modules.best.scores.grades.red')) {
            if ($talentAvg < config('modules.best.scores.grades.nonlight')) {
                $comment[] = __("Organisation has to seriously support & develop employees in preparing them to perform & contribute to the organisational operations. Ignoring the role played by employees may significantly impact organisational effectiveness.");
            } else {
                $comment[] = __("Organisation has show some basic processes in place but more can still be done to ensure that sufficient employee development and employee involvement is implemented.");
            }
        } else {
            if ($talentAvg > config('modules.best.scores.grades.amber')) {
                $comment[] = __("Overall, very good employee development is in place where employee involvement is highly encouraged across the organisation.");
            } else {
                $comment[] = __("Overall, the score seemed to suggest that sufficient attention have been given to employees in ensuring they are able to contribute to the organisational objectives");
            }
        }

        return $comment;
    }

    /**
     * Retrieve the documentation comment.
     *
     * @param  integer $documentationAvg
     * @return string
     */
    public static function getDocumentationComment($documentationAvg)
    {
        $comment = [];

        if ($documentationAvg < config('modules.best.scores.grades.red')) {
            if ($documentationAvg < config('modules.best.scores.grades.nonlight')) {
                $comment[] = __("Detailed review of documentation practices and policies are required. This may have serious ramifications when audits needs to be carried, internally or externally.");
            } else {
                $comment[] = __("While some documentation processes are observed, more can still be done to ensure that these expectations are clearly communicated to employees on how it should be carried out.");
            }
        } else {
            if ($documentationAvg > config('modules.best.scores.grades.amber')) {
                $comment[] = __("Overall, documentation processes have have exceeded expectations.");
            } else {
                $comment[] = __("Overall, the documentation processes and adoption across the organisation have met the minimum expectations.");
            }
        }

        return $comment;
    }

    /**
     * Retrieve the technology comment.
     *
     * @param  integer $technologyAvg
     * @param  string  $name
     * @return string
     */
    public static function getTechnologyComment($technologyAvg, $name)
    {
        $comment = [];

        if ($technologyAvg < config('modules.best.scores.grades.red')) {
            if ($technologyAvg < config('modules.best.scores.grades.nonlight')) {
                $comment[] = __("A comprehensive ICT needs analysis is strongly advised given the minimal technology utilisation. Rapid technology advancement may leave organisation far behind if not adopted appropriately.");
            } else {
                $comment[] = __("While some use of technology is in place, more needs to be done to ensure that the processes maximises the available systems and tools available to achieve greater work efficiency.");
            }
        } else {
            if ($technologyAvg > config('modules.best.scores.grades.amber')) {
                $comment[] = __("Overall, substantial technology adoption is present that should drive the organisational efficiency and facilitate streamlining of work processes.");
            } else {
                $comment[] = __("Overall, :name has shown efforts to integrate and adopt relevant technology to enhance their work processes.", ['name' => $name]);
            }
        }

        return $comment;
    }
}
