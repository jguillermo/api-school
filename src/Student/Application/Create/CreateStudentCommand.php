<?php


namespace School\Student\Application\Create;


use School\Shared\Domain\Bus\Command\Command;
use School\Student\Domain\Student;
use School\Student\Domain\StudentRepository;

class CreateStudentCommand implements Command
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}