<?php

namespace App\Event;

use App\Course\Domain\CourseCreatedDomainEvent;
use App\Course\Domain\CourseDeletedDomainEvent;
use App\Enrollment\Application\DeleteByCourseId\DeleteEnrollmentByCourseIdCommand;
use App\Exam\Application\Delete\DeleteExamByIdCommand;
use App\Exam\Application\FindAll\FindAllExamQuery;
use App\Exam\Application\ListExamResponse;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Shared\Domain\Bus\Query\QueryBus;

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