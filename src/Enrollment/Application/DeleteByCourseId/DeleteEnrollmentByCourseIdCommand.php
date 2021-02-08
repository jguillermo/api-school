<?php


namespace App\Enrollment\Application\DeleteByCourseId;

use App\Shared\Domain\Bus\Command\Command;

class DeleteEnrollmentByCourseIdCommand implements Command
{
    public $courseId;

    public function __construct($courseId)
    {
        $this->courseId = $courseId;
    }


}