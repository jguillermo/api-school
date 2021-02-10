<?php

namespace App\Event;

use School\Course\Domain\CourseCreatedDomainEvent;
use School\Course\Domain\CourseDeletedDomainEvent;
use School\Enrollment\Application\DeleteByCourseId\DeleteEnrollmentByCourseIdCommand;
use School\Exam\Application\Delete\DeleteExamByIdCommand;
use School\Exam\Application\FindAll\FindAllExamQuery;
use School\Exam\Application\ListExamResponse;
use School\Shared\Domain\Bus\Command\CommandBus;
use School\Shared\Domain\Bus\Event\DomainEventSubscriber;
use School\Shared\Domain\Bus\Query\QueryBus;

class DeleteExamsOnCourseDeleted implements DomainEventSubscriber
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
        return [CourseDeletedDomainEvent::class];
    }

    public function __invoke(CourseDeletedDomainEvent $event)
    {
        /** @var ListExamResponse $response */
        $response = $this->queryBus->ask(new FindAllExamQuery($event->aggregateId(), false));
        foreach ($response->exams as $exam) {
            $this->commandBus->dispatch(new DeleteExamByIdCommand(
                $exam->id,
                $event->aggregateId(),
                false
            ));
        }

    }
}