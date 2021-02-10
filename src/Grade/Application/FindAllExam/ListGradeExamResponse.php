<?php


namespace App\Grade\Application\FindAllExam;


use App\Shared\Domain\Bus\Query\Response;
use App\Grade\Domain\Grade;

class ListGradeExamResponse implements Response
{
    public $gradesIds;

    public function __construct($gradesIds)
    {
        $this->gradesIds = $gradesIds;
    }

}