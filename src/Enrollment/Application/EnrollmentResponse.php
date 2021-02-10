<?php


namespace School\Enrollment\Application;


use School\Shared\Domain\Bus\Query\Response;
use School\Enrollment\Domain\Enrollment;

class EnrollmentResponse implements Response
{
    public $courseName;
    public $courseId;

    public function __construct($courseName, $courseId)
    {
        $this->courseName = $courseName;
        $this->courseId = $courseId;
    }
}