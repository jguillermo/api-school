<?php


namespace School\Grade\Application;


use School\Shared\Domain\Bus\Query\Response;
use School\Grade\Domain\Grade;

class GradeResponse implements Response
{
    public $grade;
    public $studentId;
    public $courseId;
    public $examId;

    public function __construct(Grade $grade)
    {
        $this->grade = $grade->grade();
        $this->studentId = $grade->exam()->studentId();
        $this->courseId = $grade->exam()->courseId();
        $this->examId = $grade->exam()->examId();
    }

}