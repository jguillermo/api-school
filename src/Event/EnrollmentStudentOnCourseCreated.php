<?php


namespace App\Event;


use App\Course\Domain\CourseCreatedDomainEvent;
use App\Enrollment\Application\Create\CreateEnrollmentCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Student\Application\FindAll\FindAllStudentQuery;
use App\Student\Application\ListStudentResponse;
use App\Student\Application\StudentResponse;

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