<?php


namespace App\Exam\Application\Create;


use App\Course\Application\FindCourse\FindCourseByIdQuery;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Exam\Domain\Exam;
use App\Exam\Domain\ExamRepository;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\Bus\Query\QueryBus;

class CreateExamCommandHandler implements CommandHandler
{
    private $repository;
    private $bus;
    private $queryBus;

    public function __construct(ExamRepository $repository, EventBus $bus, QueryBus $queryBus)
    {
        $this->repository = $repository;
        $this->bus = $bus;
        $this->queryBus = $queryBus;
    }


    public function __invoke(CreateExamCommand $command)
    {
        $course = $this->queryBus->ask(new FindCourseByIdQuery($command->courseId));
        $exam = $this->repository->findById($command->id);
        if ($exam == null) {
            $exam = Exam::create($command->id, $command->title, $command->courseId);
        }
        $exam->update($command->title);
        $this->repository->persist($exam);
        $this->bus->publish(...$exam->pullDomainEvents());
    }
}