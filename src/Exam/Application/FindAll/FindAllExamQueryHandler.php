<?php


namespace App\Exam\Application\FindAll;


use App\Course\Application\FindCourse\FindCourseByIdQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Exam\Application\ListExamResponse;
use App\Exam\Application\ExamResponse;
use App\Exam\Domain\ExamRepository;

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