<?php


namespace App\Student\Domain;


interface StudentRepository
{
    public function persist(Student $student): void;

    public function findById(string $id): ?Student;

    public function findAll();

    public function remove(string $id): void;
}