<?php


namespace App\Student\Application\FindAll;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Student\Application\ListStudentResponse;
use App\Student\Application\StudentResponse;
use App\Student\Domain\StudentRepository;

class FindAllStudentQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindAllStudentQuery $query): ListStudentResponse
    {
        $students = $this->repository->findAll();
        $responses = [];
        foreach ($students as $student){
            $responses[]=new StudentResponse($student);
        }
        return new ListStudentResponse($responses);
    }
}