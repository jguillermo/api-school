<?php


namespace School\Exam\Application;


use School\Shared\Domain\Bus\Query\Response;
use School\Exam\Domain\Exam;

class ExamResponse implements Response
{
    public $id;
    public $title;

    public function __construct(Exam $exam)
    {
        $this->id = $exam->id();
        $this->title = $exam->title();
    }

}