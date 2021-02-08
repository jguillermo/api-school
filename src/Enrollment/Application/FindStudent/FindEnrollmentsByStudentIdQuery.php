<?php


namespace App\Enrollment\Application\FindStudent;

use App\Shared\Domain\Bus\Query\Query;

class FindEnrollmentsByStudentIdQuery implements Query
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}