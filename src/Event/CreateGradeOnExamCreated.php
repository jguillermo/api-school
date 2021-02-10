<?php


namespace App\Event;


use App\Enrollment\Application\FindByCourse\FindEnrollmentsByCourseIdQuery;
use App\Enrollment\Application\FindByCourse\ListEnrollmentStudentResponse;
use App\Exam\Domain\ExamCreatedDomainEvent;
use App\Grade\Application\Create\CreateGradeCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Utils;
use App\Shared\Domain\ValueObject\Uuid;

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