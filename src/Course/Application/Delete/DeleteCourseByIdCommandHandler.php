<?php

namespace App\Course\Application\Delete;


use App\Course\Domain\Course;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Course\Domain\CourseRepository;
use App\Shared\Domain\Bus\Event\EventBus;

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