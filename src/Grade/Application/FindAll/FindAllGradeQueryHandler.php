<?php


namespace School\Grade\Application\FindAll;


use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Grade\Application\ListGradeResponse;
use School\Grade\Application\GradeResponse;
use School\Grade\Domain\GradeRepository;

class FindAllGradeQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(GradeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindAllGradeQuery $query): ListGradeResponse
    {
        $grades = $this->repository->findAll();
        $responses = [];
        foreach ($grades as $grade){
            $responses[]=new GradeResponse($grade);
        }
        return new ListGradeResponse($responses);
    }
}