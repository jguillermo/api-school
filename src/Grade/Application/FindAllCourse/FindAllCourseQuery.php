<?php


namespace App\Grade\Application\FindAllCourse;


use App\Shared\Domain\Bus\Query\Query;

class FindAllCourseQuery implements Query
{
    public $courseId;

    public function __construct($courseId)
    {
        $this->courseId = $courseId;
    }

}