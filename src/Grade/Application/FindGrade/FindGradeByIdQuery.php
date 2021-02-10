<?php


namespace School\Grade\Application\FindGrade;

use School\Shared\Domain\Bus\Query\Query;

class FindGradeByIdQuery implements Query
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}