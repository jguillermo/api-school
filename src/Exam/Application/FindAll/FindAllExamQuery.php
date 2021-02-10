<?php


namespace School\Exam\Application\FindAll;


use School\Shared\Domain\Bus\Query\Query;

class FindAllExamQuery implements Query
{
    public $courseId;
    public $validate;

    public function __construct($courseId, $validate = true)
    {
        $this->courseId = $courseId;
        $this->validate = $validate;
    }


}