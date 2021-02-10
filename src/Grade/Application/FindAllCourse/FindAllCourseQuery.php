<?php


namespace School\Grade\Application\FindAllCourse;


use School\Shared\Domain\Bus\Query\Query;

class FindAllCourseQuery implements Query
{
    public $courseId;

    public function __construct($courseId)
    {
        $this->courseId = $courseId;
    }

}