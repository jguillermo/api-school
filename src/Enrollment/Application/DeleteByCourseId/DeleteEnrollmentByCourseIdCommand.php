<?php


namespace School\Enrollment\Application\DeleteByCourseId;

use School\Shared\Domain\Bus\Command\Command;

class DeleteEnrollmentByCourseIdCommand implements Command
{
    public $courseId;

    public function __construct($courseId)
    {
        $this->courseId = $courseId;
    }


}