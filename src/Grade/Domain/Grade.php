<?php


namespace App\Grade\Domain;


class Grade
{
    private $id;
    private $grade;
    private $exam;

    public function __construct($id, $grade, Exam $exam)
    {
        $this->id = $id;
        $this->grade = $grade;
        $this->exam = $exam;
    }


    public static function create($id, $grade, Exam $exam):Grade{
        return new Grade($id, $grade, $exam);
    }

    public function id()
    {
        return $this->id;
    }

    public function grade()
    {
        return $this->grade;
    }

    public function exam(): Exam
    {
        return $this->exam;
    }

}