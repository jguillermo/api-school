<?php


namespace School\Course\Application;


use School\Shared\Domain\Bus\Query\Response;
use School\Course\Domain\Course;

class CourseResponse implements Response
{
    public $id;
    public $name;

    public function __construct(Course $Course)
    {
        $this->id = $Course->id();
        $this->name = $Course->name();
    }

}