<?php


namespace App\Grade\Application\FindAllCourse;


use App\Grade\Domain\Exam;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Grade\Application\ListGradeResponse;
use App\Grade\Application\GradeResponse;
use App\Grade\Domain\GradeRepository;

class FindAllCourseQueryHandler implements QueryHandler
{

    private $repository;

    public function __construct(GradeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindAllCourseQuery $query): ListGradeResponse
    {
        $grades = $this->repository->findAllByType(Exam::COURSE, $query->courseId);
        $responses = [];
        foreach ($grades as $grade) {
            $responses[] = new GradeResponse($grade);
        }
        return new ListGradeResponse($responses);
    }
}