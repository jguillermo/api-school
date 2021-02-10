<?php


namespace School\Grade\Application\FindAllStudent;


use School\Shared\Domain\Bus\Query\Query;

class FindAllGradesByStudentQuery implements Query
{
    public $studentId;

    public function __construct($studentId)
    {
        $this->studentId = $studentId;
    }

}