<?php


namespace App\Course\Application\Create;


use App\Shared\Domain\Bus\Command\Command;
use App\Course\Domain\Course;
use App\Course\Domain\CourseRepository;

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