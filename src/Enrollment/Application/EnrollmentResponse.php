<?php


namespace App\Enrollment\Application;


use App\Shared\Domain\Bus\Query\Response;
use App\Enrollment\Domain\Enrollment;

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