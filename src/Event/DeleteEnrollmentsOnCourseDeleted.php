<?php
namespace App\Event;

use App\Course\Domain\CourseCreatedDomainEvent;
use App\Course\Domain\CourseDeletedDomainEvent;
use App\Enrollment\Application\DeleteByCourseId\DeleteEnrollmentByCourseIdCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Shared\Domain\Bus\Query\QueryBus;

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