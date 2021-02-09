<?php

namespace App\Exam\Application\FindExam;

use App\Course\Application\FindCourse\FindCourseByIdQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Exam\Application\ExamResponse;
use App\Exam\Domain\ExamRepository;
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