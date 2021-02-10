<?php


namespace School\Course\Domain;


use School\Shared\Domain\Aggregate\AggregateRoot;

class Course extends AggregateRoot
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function create($id,$name):Course{
        $course= new Course($id,$name);
        $course->record(new CourseCreatedDomainEvent($id,$name));
        return $course;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function changeName(string $name)
    {
        $this->name = $name;
    }

    public function delete()
    {
        $this->record(new CourseDeletedDomainEvent($this->id,$this->name));
    }

}