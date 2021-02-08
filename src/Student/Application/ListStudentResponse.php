<?php


namespace App\Student\Application;


use App\Shared\Domain\Bus\Query\Response;
use App\Student\Domain\Student;

class ListStudentResponse implements Response
{
    public $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

}