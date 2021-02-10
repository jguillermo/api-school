<?php


namespace School\Course\Application;


use School\Shared\Domain\Bus\Query\Response;
use School\Course\Domain\Course;

class ListCourseResponse implements Response
{
    public $courses;

    public function __construct($courses)
    {
        $this->courses = $courses;
    }

}