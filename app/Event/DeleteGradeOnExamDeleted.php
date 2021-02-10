<?php


namespace App\Event;


use School\Exam\Domain\ExamDeletedDomainEvent;
use School\Grade\Application\Delete\DeleteGradeByIdCommand;
use School\Grade\Application\FindAllExam\FindAllGradeByExamQuery;
use School\Grade\Application\FindAllExam\ListGradeExamResponse;
use School\Grade\Application\ListGradeResponse;
use School\Shared\Domain\Bus\Command\CommandBus;
use School\Shared\Domain\Bus\Event\DomainEventSubscriber;
use School\Shared\Domain\Bus\Query\QueryBus;


class DeleteGradeOnExamDeleted implements DomainEventSubscriber
{
    private $commandBus;
    private $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public static function subscribedTo(): array
    {
        return [ExamDeletedDomainEvent::class];
    }

    public function __invoke(ExamDeletedDomainEvent $event)
    {
        print("deleted");
        /** @var ListGradeExamResponse $response */
        $response = $this->queryBus->ask(new FindAllGradeByExamQuery($event->aggregateId()));
        foreach ($response->gradesIds as $id) {
            $this->commandBus->dispatch(new DeleteGradeByIdCommand($id));
        }
    }
}