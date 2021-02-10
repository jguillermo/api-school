<?php


namespace School\Student\Application\FindAll;


use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Student\Application\ListStudentResponse;
use School\Student\Application\StudentResponse;
use School\Student\Domain\StudentRepository;

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