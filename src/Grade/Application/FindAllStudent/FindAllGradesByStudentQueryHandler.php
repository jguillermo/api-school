<?php


namespace School\Grade\Application\FindAllStudent;


use School\Grade\Domain\Exam;
use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Grade\Application\ListGradeResponse;
use School\Grade\Application\GradeResponse;
use School\Grade\Domain\GradeRepository;

class FindAllGradesByStudentQueryHandler implements QueryHandler
{

    private $repository;

    public function __construct(GradeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindAllGradesByStudentQuery $query): ListGradeResponse
    {
        $grades = $this->repository->findAllByType(Exam::STUDENT, $query->studentId);
        $responses = [];
        foreach ($grades as $grade) {
            $responses[] = new GradeResponse($grade);
        }
        return new ListGradeResponse($responses);
    }
}