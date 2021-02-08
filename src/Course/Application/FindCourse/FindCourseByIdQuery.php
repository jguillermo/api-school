<?php


namespace App\Course\Application\FindCourse;

use App\Shared\Domain\Bus\Query\Query;

class FindCourseByIdQuery implements Query
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}