<?php


namespace School\Grade\Application\FindAllExam;


use School\Shared\Domain\Bus\Query\Response;
use School\Grade\Domain\Grade;

class ListGradeExamResponse implements Response
{
    public $gradesIds;

    public function __construct($gradesIds)
    {
        $this->gradesIds = $gradesIds;
    }

}