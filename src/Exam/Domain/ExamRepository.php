<?php


namespace App\Exam\Domain;


interface ExamRepository
{
    public function persist(Exam $exam): void;

    public function findById(string $id): ?Exam;

    public function findAll();

    public function remove(string $id): void;

    /**
     * @param $courseId
     * @return Exam[]
     */
    public function findAllByCourseId($courseId);
}