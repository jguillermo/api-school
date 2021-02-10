<?php


namespace App\Event;


use School\Enrollment\Application\FindByCourse\FindEnrollmentsByCourseIdQuery;
use School\Enrollment\Application\FindByCourse\ListEnrollmentStudentResponse;
use School\Exam\Domain\ExamCreatedDomainEvent;
use School\Grade\Application\Create\CreateGradeCommand;
use School\Shared\Domain\Bus\Command\CommandBus;
use School\Shared\Domain\Bus\Event\DomainEventSubscriber;
use School\Shared\Domain\Bus\Query\QueryBus;
use School\Shared\Domain\Utils;
use School\Shared\Domain\ValueObject\Uuid;

class CreateGradeOnExamCreated implements DomainEventSubscriber
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
        return [ExamCreatedDomainEvent::class];
    }

    public function __invoke(ExamCreatedDomainEvent $event)
    {
        /** @var ListEnrollmentStudentResponse $response */
        $response = $this->queryBus->ask(new FindEnrollmentsByCourseIdQuery($event->getCourseId()));
        foreach($response->students as $student) {
            $id =Uuid::random()->value();
            $this->commandBus->dispatch(new CreateGradeCommand(
                $id,16,$event->aggregateId(),$student,$event->getCourseId()
            ));
        }

    }
}