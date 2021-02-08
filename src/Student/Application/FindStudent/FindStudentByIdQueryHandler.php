<?php


namespace App\Student\Application\FindStudent;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Student\Application\StudentResponse;
use App\Student\Domain\Student;
use App\Student\Domain\StudentRepository;
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