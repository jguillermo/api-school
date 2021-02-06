<?php


namespace App\Student\Application;


use App\Student\Domain\Student;
use App\Student\Domain\StudentRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreateStudent
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }


    public function execute(string $id, string $name)
    {
        $student = $this->repository->findById($id);
        if ($student == null) {
            $student = Student::create($id, $name);
        }
        $student->changeName($name);
        $this->repository->persist($student);
    }
}