<?php


namespace School\Course\Application\Create;


use School\Shared\Domain\Bus\Command\Command;
use School\Course\Domain\Course;
use School\Course\Domain\CourseRepository;

class CreateCourseCommand implements Command
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}