<?php


namespace App\Event;


use School\Course\Domain\CourseCreatedDomainEvent;
use School\Enrollment\Application\Create\CreateEnrollmentCommand;
use School\Shared\Domain\Bus\Command\CommandBus;
use School\Shared\Domain\Bus\Event\DomainEventSubscriber;
use School\Shared\Domain\Bus\Query\QueryBus;
use School\Student\Application\FindAll\FindAllStudentQuery;
use School\Student\Application\ListStudentResponse;
use School\Student\Application\StudentResponse;

class EnrollmentStudentOnCourseCreated implements DomainEventSubscriber
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
        return [CourseCreatedDomainEvent::class];
    }

    public function __invoke(CourseCreatedDomainEvent $event)
    {
        /** @var ListStudentResponse $reponse */
        $reponse = $this->queryBus->ask(new FindAllStudentQuery());
        foreach ($reponse->students as $student){
            $this->commandBus->dispatch(new CreateEnrollmentCommand(
                $event->aggregateId(),
                $student->id
            ));
        }

    }
}