<?php

namespace School\Course\Application\Delete;


use School\Course\Domain\Course;
use School\Shared\Domain\Bus\Command\CommandHandler;
use School\Course\Domain\CourseRepository;
use School\Shared\Domain\Bus\Event\EventBus;

class DeleteCourseByIdCommandHandler implements CommandHandler
{
    private $repository;
    private $bus;

    public function __construct(CourseRepository $repository, EventBus $bus)
    {
        $this->repository = $repository;
        $this->bus        = $bus;
    }


    public function __invoke(DeleteCourseByIdCommand $command)
    {
        $course = $this->repository->findById($command->id);
        if ($course == null) {
            return;
        }
        $course->delete();
        $this->repository->remove($command->id);
        $this->bus->publish(...$course->pullDomainEvents());
        return;
    }
}