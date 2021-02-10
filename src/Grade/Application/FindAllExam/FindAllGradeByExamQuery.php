<?php


namespace App\Grade\Application\FindAllExam;


use App\Shared\Domain\Bus\Query\Query;

class FindAllGradeByExamQuery implements Query
{
    public $examId;

    public function __construct($examId)
    {
        $this->examId = $examId;
    }

}