<?php


namespace App\Exam\Application\FindExam;

use App\Shared\Domain\Bus\Query\Query;

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