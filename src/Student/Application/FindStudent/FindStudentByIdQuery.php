<?php


namespace School\Student\Application\FindStudent;

use School\Shared\Domain\Bus\Query\Query;

class FindStudentByIdQuery implements Query
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}