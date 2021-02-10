<?php


namespace School\Grade\Application\FindAllExam;


use School\Grade\Domain\Exam;
use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Grade\Application\ListGradeResponse;
use School\Grade\Application\GradeResponse;
use School\Grade\Domain\GradeRepository;

class FindAllGradeByExamQueryHandler implements QueryHandler
{

    private $repository;

    public function __construct(GradeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindAllGradeByExamQuery $query): ListGradeExamResponse
    {
        $grades = $this->repository->findAllByType(Exam::EXAM, $query->examId);
        $responses = [];
        foreach ($grades as $grade) {
            $responses[] = $grade->id();
        }
        return new ListGradeExamResponse($responses);
    }
}