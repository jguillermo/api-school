<?php


namespace App\Student\Application\Create;


use App\Shared\Domain\Bus\Command\Command;
use App\Student\Domain\Student;
use App\Student\Domain\StudentRepository;

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