<?php


namespace School\Exam\Application\FindAll;


use School\Course\Application\FindCourse\FindCourseByIdQuery;
use School\Shared\Domain\Bus\Query\QueryBus;
use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Exam\Application\ListExamResponse;
use School\Exam\Application\ExamResponse;
use School\Exam\Domain\ExamRepository;

class FindAllExamQueryHandler implements QueryHandler
{
    private $repository;
    private $queryBus;

    public function __construct(ExamRepository $repository, QueryBus $queryBus)
    {
        $this->repository = $repository;
        $this->queryBus = $queryBus;
    }

    public function __invoke(FindAllExamQuery $query): ListExamResponse
    {
        if($query->validate){
            $this->queryBus->ask(new FindCourseByIdQuery($query->courseId));
        }
        $exams = $this->repository->findAllByCourseId($query->courseId);
        $responses = [];
        foreach ($exams as $exam){
            $responses[]=new ExamResponse($exam);
        }
        return new ListExamResponse($responses);
    }
}