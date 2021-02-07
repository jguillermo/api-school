<?php


namespace App\Student\Application;


use App\Student\Domain\Student;

class StudentResponse
{
    public $id;
    public $name;

    public function __construct(Student $student)
    {
        $this->id = $student->id();
        $this->name = $student->name();
    }

}