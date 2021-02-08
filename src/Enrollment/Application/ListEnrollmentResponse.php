<?php


namespace App\Enrollment\Application;


use App\Shared\Domain\Bus\Query\Response;
use App\Enrollment\Domain\Enrollment;

class ListEnrollmentResponse implements Response
{
    public $enrollments;

    public function __construct($enrollments)
    {
        $this->enrollments = $enrollments;
    }

}