<?php


namespace School\Enrollment\Application;


use School\Shared\Domain\Bus\Query\Response;
use School\Enrollment\Domain\Enrollment;

class ListEnrollmentResponse implements Response
{
    public $enrollments;

    public function __construct($enrollments)
    {
        $this->enrollments = $enrollments;
    }

}