<?php


namespace School\Grade\Domain;


class Exam
{
    const STUDENT = 'student';
    const COURSE = 'course';
    const EXAM = 'exam';

    private $examId;
    private $studentId;
    private $courseId;

    public function __construct($examId, $studentId, $courseId)
    {
        $this->examId = $examId;
        $this->studentId = $studentId;
        $this->courseId = $courseId;
    }

    public function studentId()
    {
        return $this->studentId;
    }

    public function courseId()
    {
        return $this->courseId;
    }

    public function examId()
    {
        return $this->examId;
    }


}