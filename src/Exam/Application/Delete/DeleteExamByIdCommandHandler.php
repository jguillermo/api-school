<?php

namespace App\Exam\Application\Delete;


use App\Course\Application\FindCourse\FindCourseByIdQuery;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Exam\Domain\ExamRepository;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\Bus\Query\QueryBus;

class DeleteExamByIdCommandHandler implements CommandHandler
{
    private $repository;
    private $bus;
    private $queryBus;

    public function __construct(ExamRepository $repository, EventBus $bus, QueryBus $queryBus)
    {
        $this->repository = $repository;
        $this->bus = $bus;
        $this->queryBus = $queryBus;
    }

    public function __invoke(DeleteExamByIdCommand $command)
    {
        if($command->validate){
            $this->queryBus->ask(new FindCourseByIdQuery($command->courseId));
        }
        $exam = $this->repository->findById($command->examId);
        if ($exam == null) {
            return;
        }
        $exam->delete();
        $this->repository->remove($command->examId);
        $this->bus->publish(...$exam->pullDomainEvents());
        return;
    }
}