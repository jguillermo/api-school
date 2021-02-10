<?php


namespace School\Student\Application;


use School\Shared\Domain\Bus\Query\Response;
use School\Student\Domain\Student;

class ListStudentResponse implements Response
{
    public $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

}