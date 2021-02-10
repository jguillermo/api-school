<?php


namespace School\Student\Application\FindStudent;


use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Student\Application\StudentResponse;
use School\Student\Domain\Student;
use School\Student\Domain\StudentRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FindStudentByIdQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindStudentByIdQuery $query): StudentResponse
    {
        $student = $this->repository->findById($query->id);
        if($student == null){
            throw new NotFoundHttpException("Student not found");
        }
        return new StudentResponse($student);
    }
}