<?php


namespace App\Grade\Application\FindAllStudent;


use App\Shared\Domain\Bus\Query\Query;

class FindAllGradesByStudentQuery implements Query
{
    public $studentId;

    public function __construct($studentId)
    {
        $this->studentId = $studentId;
    }

}