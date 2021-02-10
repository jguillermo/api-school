<?php


namespace App\Enrollment\Application\FindByCourse;

use App\Shared\Domain\Bus\Query\Query;

class FindEnrollmentsByCourseIdQuery implements Query
{
    public $courseId;

    public function __construct($courseId)
    {
        $this->courseId = $courseId;
    }
}