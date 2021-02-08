<?php


namespace App\Student\Application;


use App\Shared\Domain\Bus\Query\Response;
use App\Student\Domain\Student;

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