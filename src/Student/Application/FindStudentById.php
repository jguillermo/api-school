<?php


namespace App\Student\Application;


use App\Student\Domain\Student;
use App\Student\Domain\StudentRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FindStudentById
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id)
    {
        $student = $this->repository->findById($id);
        if($student == null){
            throw new NotFoundHttpException("Student not found");
        }
        return new StudentResponse($student);
    }
}