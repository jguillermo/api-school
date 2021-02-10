<?php


namespace App\Grade\Application\FindGrade;

use App\Shared\Domain\Bus\Query\Query;

class FindGradeByIdQuery implements Query
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}