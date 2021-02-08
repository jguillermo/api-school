<?php


namespace App\Student\Application\FindStudent;

use App\Shared\Domain\Bus\Query\Query;

class FindStudentByIdQuery implements Query
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}