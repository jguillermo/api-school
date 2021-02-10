<?php


namespace School\Student\Application;


use School\Shared\Domain\Bus\Query\Response;
use School\Student\Domain\Student;

class StudentResponse implements Response
{
    public $id;
    public $name;

    public function __construct(Student $student)
    {
        $this->id = $student->id();
        $this->name = $student->name();
    }

}