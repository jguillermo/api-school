<?php


namespace App\Student\Domain;


class Student
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function create($id,$name):Student{
        return new Student($id,$name);
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

}