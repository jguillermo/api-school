<?php


namespace App\Enrollment\Domain;


class Enrollment
{
    private $courseId;
    private $studentId;

    public function __construct($courseId, $studentId)
    {
        $this->courseId = $courseId;
        $this->studentId = $studentId;
    }

    public static function create($courseId, $studentId)
    {
        return new Enrollment($courseId, $studentId);
    }


    public function courseId()
    {
        return $this->courseId;
    }

    public function studentId()
    {
        return $this->studentId;
    }

}