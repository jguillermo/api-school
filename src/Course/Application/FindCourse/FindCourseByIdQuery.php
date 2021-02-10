<?php


namespace School\Course\Application\FindCourse;

use School\Shared\Domain\Bus\Query\Query;

class FindCourseByIdQuery implements Query
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}