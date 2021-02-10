<?php


namespace School\Grade\Application\FindAllCourse;


use School\Grade\Domain\Exam;
use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Grade\Application\ListGradeResponse;
use School\Grade\Application\GradeResponse;
use School\Grade\Domain\GradeRepository;

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