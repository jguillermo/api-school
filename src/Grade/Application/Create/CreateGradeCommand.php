<?php


namespace School\Grade\Application\Create;


use School\Shared\Domain\Bus\Command\Command;
use School\Grade\Domain\Grade;
use School\Grade\Domain\GradeRepository;

class CreateGradeCommand implements Command
{
    public $id;
    public $grade;
    public $examId;
    public $studentId;
    public $courseId;

    public function __construct($id, $grade, $examId, $studentId, $courseId)
    {
        $this->id = $id;
        $this->grade = $grade;
        $this->examId = $examId;
        $this->studentId = $studentId;
        $this->courseId = $courseId;
    }

}