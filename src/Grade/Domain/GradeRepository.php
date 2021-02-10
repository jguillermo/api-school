<?php


namespace App\Grade\Domain;


interface GradeRepository
{
    public function persist(Grade $grade): void;

    public function findById(string $id): ?Grade;

    public function findAll();

    public function remove(string $id): void;

    /**
     * @return Grade[]
     */
    public function findAllByType(string $type, string $studentId);
}