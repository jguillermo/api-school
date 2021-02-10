<?php


namespace School\Course\Domain;


interface CourseRepository
{
    public function persist(Course $Course): void;

    public function findById(string $id): ?Course;

    public function findAll();

    public function remove(string $id): void;
}