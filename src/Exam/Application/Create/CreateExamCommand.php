<?php


namespace School\Exam\Application\Create;


use School\Shared\Domain\Bus\Command\Command;
use School\Exam\Domain\Exam;
use School\Exam\Domain\ExamRepository;

class CreateExamCommand implements Command
{
    public $id;
    public $title;
    public $courseId;

    public function __construct($id, $title, $courseId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->courseId = $courseId;
    }


}