<?php


namespace App\Course\Application;


use App\Shared\Domain\Bus\Query\Response;
use App\Course\Domain\Course;

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