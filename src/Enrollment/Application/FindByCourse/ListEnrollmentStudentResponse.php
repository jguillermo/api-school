<?php


namespace App\Enrollment\Application\FindByCourse;


use App\Shared\Domain\Bus\Query\Response;
use App\Enrollment\Domain\Enrollment;

class ListEnrollmentStudentResponse implements Response
{
    public $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

}