<?php


namespace App\Student\Application;


use App\Student\Domain\Student;
use App\Student\Domain\StudentRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteStudentById
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id)
    {

        $this->repository->remove($id);
        return;
    }
}