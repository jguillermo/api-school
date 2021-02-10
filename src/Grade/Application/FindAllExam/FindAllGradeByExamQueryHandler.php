<?php


namespace App\Grade\Application\FindAllExam;


use App\Grade\Domain\Exam;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Grade\Application\ListGradeResponse;
use App\Grade\Application\GradeResponse;
use App\Grade\Domain\GradeRepository;

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