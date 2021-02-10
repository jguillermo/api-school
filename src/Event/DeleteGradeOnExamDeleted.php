<?php


namespace App\Event;


use App\Exam\Domain\ExamDeletedDomainEvent;
use App\Grade\Application\Delete\DeleteGradeByIdCommand;
use App\Grade\Application\FindAllExam\FindAllGradeByExamQuery;
use App\Grade\Application\FindAllExam\ListGradeExamResponse;
use App\Grade\Application\ListGradeResponse;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Shared\Domain\Bus\Query\QueryBus;


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