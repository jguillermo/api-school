<?php


namespace App\Grade\Application\FindAllStudent;


use App\Grade\Domain\Exam;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Grade\Application\ListGradeResponse;
use App\Grade\Application\GradeResponse;
use App\Grade\Domain\GradeRepository;

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