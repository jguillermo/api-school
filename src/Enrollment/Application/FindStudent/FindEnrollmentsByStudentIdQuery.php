<?php


namespace School\Enrollment\Application\FindStudent;

use School\Shared\Domain\Bus\Query\Query;

class FindEnrollmentsByStudentIdQuery implements Query
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}