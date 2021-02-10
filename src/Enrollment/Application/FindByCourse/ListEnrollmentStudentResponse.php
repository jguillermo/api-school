<?php


namespace School\Enrollment\Application\FindByCourse;


use School\Shared\Domain\Bus\Query\Response;
use School\Enrollment\Domain\Enrollment;

class ListEnrollmentStudentResponse implements Response
{
    public $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

}