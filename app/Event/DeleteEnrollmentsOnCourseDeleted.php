<?php
namespace App\Event;

use School\Course\Domain\CourseCreatedDomainEvent;
use School\Course\Domain\CourseDeletedDomainEvent;
use School\Enrollment\Application\DeleteByCourseId\DeleteEnrollmentByCourseIdCommand;
use School\Shared\Domain\Bus\Command\CommandBus;
use School\Shared\Domain\Bus\Event\DomainEventSubscriber;
use School\Shared\Domain\Bus\Query\QueryBus;

class DeleteEnrollmentsOnCourseDeleted implements DomainEventSubscriber
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
       $this->commandBus->dispatch(new DeleteEnrollmentByCourseIdCommand(
            $event->aggregateId()
        ));
    }
}