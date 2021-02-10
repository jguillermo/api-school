<?php


namespace School\Enrollment\Application\FindByCourse;

use School\Shared\Domain\Bus\Query\Query;

class FindEnrollmentsByCourseIdQuery implements Query
{
    public $courseId;

    public function __construct($courseId)
    {
        $this->courseId = $courseId;
    }
}