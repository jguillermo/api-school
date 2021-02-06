<?php


namespace App\Student\Infrastructure\Persistence;


use App\Student\Domain\Student;
use App\Student\Domain\StudentRepository;

class StudentSqlRepository implements StudentRepository
{

    public function persist(Student $student): void
    {
        // TODO: Implement persist() method.
    }

    public function findById(string $id): ?Student
    {
        return null;
    }

    public function findAll()
    {
        return [];
    }

    public function remove(string $id): void
    {
        // TODO: Implement remove() method.
    }
}