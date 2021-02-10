<?php


namespace School\Grade\Application;


use School\Shared\Domain\Bus\Query\Response;
use School\Grade\Domain\Grade;

class ListGradeResponse implements Response
{
    /** @var GradeResponse[] */
    public $grades;

    public function __construct($grades)
    {
        $this->grades = $grades;
    }

}