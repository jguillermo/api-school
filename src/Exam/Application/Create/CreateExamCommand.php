<?php


namespace App\Exam\Application\Create;


use App\Shared\Domain\Bus\Command\Command;
use App\Exam\Domain\Exam;
use App\Exam\Domain\ExamRepository;

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