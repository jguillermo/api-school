<?php


namespace School\Grade\Application\FindAllExam;


use School\Shared\Domain\Bus\Query\Query;

class FindAllGradeByExamQuery implements Query
{
    public $examId;

    public function __construct($examId)
    {
        $this->examId = $examId;
    }

}