<?php


namespace School\Exam\Application\Create;


use School\Course\Application\FindCourse\FindCourseByIdQuery;
use School\Shared\Domain\Bus\Command\CommandHandler;
use School\Exam\Domain\Exam;
use School\Exam\Domain\ExamRepository;
use School\Shared\Domain\Bus\Event\EventBus;
use School\Shared\Domain\Bus\Query\QueryBus;

class CreateExamCommandHandler implements CommandHandler
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


    public function __invoke(CreateExamCommand $command)
    {
        $course = $this->queryBus->ask(new FindCourseByIdQuery($command->courseId));
        $exam = $this->repository->findById($command->id);
        if ($exam == null) {
            $exam = Exam::create($command->id, $command->title, $command->courseId);
        }
        $exam->update($command->title);
        $this->repository->persist($exam);
        $this->bus->publish(...$exam->pullDomainEvents());
    }
}