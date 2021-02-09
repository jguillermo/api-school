<?php


namespace App\Exam\Application;


use App\Shared\Domain\Bus\Query\Response;
use App\Exam\Domain\Exam;

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