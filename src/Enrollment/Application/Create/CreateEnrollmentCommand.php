<?php


namespace App\Enrollment\Application\Create;


use App\Shared\Domain\Bus\Command\Command;

class CreateEnrollmentCommand implements Command
{
    public $courseId;
    public $studentId;

    public function __construct($courseId, $studentId)
    {
        $this->courseId = $courseId;
        $this->studentId = $studentId;
    }


}