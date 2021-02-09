<?php


namespace App\Exam\Application\FindAll;


use App\Shared\Domain\Bus\Query\Query;

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