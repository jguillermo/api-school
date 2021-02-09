<?php


namespace App\Exam\Application;


use App\Shared\Domain\Bus\Query\Response;
use App\Exam\Domain\Exam;

class ListExamResponse implements Response
{
    /** @var ExamResponse[] */
    public $exams;

    public function __construct($exams)
    {
        $this->exams = $exams;
    }

}