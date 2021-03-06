<?php


namespace School\Enrollment\Domain;


interface EnrollmentRepository
{
    public function persist(Enrollment $enrollment): void;

    public function findByStudentId(string $id);

    public function deleteAllByCourseId($courseId);

    /**
     * @return Enrollment[]
     */
    public function findByCourse($courseId);


}