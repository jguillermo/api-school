<?php

namespace School\Exam\Application\FindExam;

use School\Course\Application\FindCourse\FindCourseByIdQuery;
use School\Shared\Domain\Bus\Query\QueryBus;
use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Exam\Application\ExamResponse;
use School\Exam\Domain\ExamRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FindExamByIdQueryHandler implements QueryHandler
{
    private $repository;
    private $queryBus;

    public function __construct(ExamRepository $repository, QueryBus $queryBus)
    {
        $this->repository = $repository;
        $this->queryBus = $queryBus;
    }

    public function __invoke(FindExamByIdQuery $query): ExamResponse
    {
        $this->queryBus->ask(new FindCourseByIdQuery($query->courseId));

        $exam = $this->repository->findById($query->id);
        if ($exam == null) {
            throw new NotFoundHttpException("Exam not found");
        }
        return new ExamResponse($exam);
    }
}