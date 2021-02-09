<?php

namespace App\Exam\Application\Delete;


use App\Shared\Domain\Bus\Command\Command;

class DeleteExamByIdCommand implements Command
{
    public $examId;
    public $courseId;
    public $validate;

    public function __construct($examId, $courseId, $validate=true)
    {
        $this->examId = $examId;
        $this->courseId = $courseId;
        $this->validate = $validate;
    }


}