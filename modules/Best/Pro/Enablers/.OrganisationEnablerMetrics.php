<?php

namespace Best\Pro\Enablers;

abstract class OrganisationEnablerMetrics
{
    const COMMENT_POINT_4_TOP = 0.4;
    const COMMENT_POINT_4_LEFT = 0.4;
    const COMMENT_POINT_8_LEFT = 0.8;
    const COMMENT_POINT_8_TOP = 0.8;

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
        $comment =  null;

        if ($techAvg < self::COMMENT_POINT_4_TOP && $workflowAvg < self::COMMENT_POINT_4_LEFT) {
            $comment = trans("Current 'Technology' adoption is not within desirable range. || This may have attributed to :name's perceived poor processes.", ['name' => $name]);
        } else {
            if ($workflowAvg < self::COMMENT_POINT_4_TOP && $techAvg > self::COMMENT_POINT_4_LEFT) {
                if ($techAvg > self::COMMENT_POINT_8_LEFT) {
                    $comment = trans(":name is strongly advised to review non-technological enablers to ensure that the technology invested is well implementated across all work processes.", ['name' => $name]);
                } else {
                    $comment = trans("While the technological adoption in  :name is within acceptable range, an in-depth review of both the talent and documentation practices is recommended to ensure that the technology is optimised to meet the operational needs.", ['name' => $name]);
                }
            } else {
                if ($techAvg > self::COMMENT_POINT_8_LEFT && $workflowAvg > self::COMMENT_POINT_8_TOP) {
                    $comment = trans("With a highly efficient workflow process supported by very good technology, any further technological investment will be expected to deliver a more significant value added improvements for :name's customers.", ['name' => $name]);
                } else {
                    if ($workflowAvg > self::COMMENT_POINT_8_TOP && $techAvg > self::COMMENT_POINT_4_TOP) {
                        if ($techAvg > self::COMMENT_POINT_8_LEFT) {
                            $comment = trans(":name has demonstrated highly desirable technology integration within its workflow processes. || Periodic review of their non-technology enablers such as talent development can be looked into and tightened to ensure that the current high standards can be sustained.", ['name' => $name]);
                        } else {
                            $comment = trans("Impressive workflow processes perceived despite the average technology adoption within :name. Organisation is advised to thread very carefully to ensure that any further technological enhancements will be meaningful and not disruptive to the current efficient processes.", ['name' => $name]);
                        }
                    } else {
                        if ($techAvg > self::COMMENT_POINT_8_LEFT && $workflowAvg > self::COMMENT_POINT_4_LEFT) {
                            if ($workflowAvg > self::COMMENT_POINT_8_TOP && $techAvg > self::COMMENT_POINT_8_LEFT) {
                                $comment = trans(":name has demonstrated highly desirable technology integration within its workflow processes. || Periodic review of their non-technology enablers such as talent development can be looked into and tightened to ensure that the current high standards can be sustained.", ['name' => $name]);
                            } else {
                                $comment = trans(":name's workflow processes has not been percieved to be highly efficient, despite the adoption of highly efficient technology solution(s). || A deep-dive into talent pool and documentation is recommended to review gaps that may exist.", ['name' => $name]);
                            }
                        } else {
                            if ($techAvg < self::COMMENT_POINT_4_TOP && $workflowAvg > sefl::COMMENT_POINT_4_LEFT) {
                                // Code goes here.
                            }
                        }
                    }
                }
            }
        }

        return $comment;
    }
}
