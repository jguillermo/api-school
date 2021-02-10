<?php


namespace App\Grade\Application;


use App\Shared\Domain\Bus\Query\Response;
use App\Grade\Domain\Grade;

class ListGradeResponse implements Response
{
    /** @var GradeResponse[] */
    public $grades;

    public function __construct($grades)
    {
        $this->grades = $grades;
    }

}