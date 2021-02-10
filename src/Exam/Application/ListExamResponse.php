<?php


namespace School\Exam\Application;


use School\Shared\Domain\Bus\Query\Response;
use School\Exam\Domain\Exam;

class ListExamResponse implements Response
{
    /** @var ExamResponse[] */
    public $exams;

    public function __construct($exams)
    {
        $this->exams = $exams;
    }

}