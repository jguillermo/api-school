<?php


namespace App\Exam\Domain;


use App\Shared\Domain\Aggregate\AggregateRoot;

class Exam extends AggregateRoot
{
    private $id;
    private $title;
    private $courseId;

    public function __construct($id, $title, $courseId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->courseId = $courseId;
    }

    public static function create($id, $title, $courseId): Exam
    {
        $exam = new Exam($id, $title, $courseId);
        $exam->record(new ExamCreatedDomainEvent($id, $title, $courseId));
        return $exam;
    }

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function courseId()
    {
        return $this->courseId;
    }

    public function update($title)
    {
        $this->title = $title;
    }

}