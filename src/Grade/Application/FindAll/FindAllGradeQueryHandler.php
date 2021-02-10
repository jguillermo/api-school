<?php


namespace App\Grade\Application\FindAll;


use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Grade\Application\ListGradeResponse;
use App\Grade\Application\GradeResponse;
use App\Grade\Domain\GradeRepository;

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