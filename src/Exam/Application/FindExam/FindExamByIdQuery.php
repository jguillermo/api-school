<?php


namespace School\Exam\Application\FindExam;

use School\Shared\Domain\Bus\Query\Query;

class FindExamByIdQuery implements Query
{
    public $id;
    public $courseId;

    public function __construct($id, $courseId)
    {
        $this->id = $id;
        $this->courseId = $courseId;
    }


}