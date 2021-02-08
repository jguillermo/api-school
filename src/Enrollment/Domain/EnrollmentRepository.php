<?php


namespace App\Enrollment\Domain;


interface EnrollmentRepository
{
    public function persist(Enrollment $enrollment): void;

    public function findByStudentId(string $id);

    public function deleteAllByCourseId($courseId);


}