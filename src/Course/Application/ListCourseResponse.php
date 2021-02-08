<?php


namespace App\Course\Application;


use App\Shared\Domain\Bus\Query\Response;
use App\Course\Domain\Course;

class ListCourseResponse implements Response
{
    public $courses;

    public function __construct($courses)
    {
        $this->courses = $courses;
    }

}