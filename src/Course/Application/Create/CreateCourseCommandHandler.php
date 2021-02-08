<?php


namespace App\Course\Application\Create;


use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Course\Domain\Course;
use App\Course\Domain\CourseRepository;
use App\Shared\Domain\Bus\Event\EventBus;

class CreateCourseCommandHandler implements CommandHandler
{
    private $repository;
    private $bus;

    public function __construct(CourseRepository $repository, EventBus $bus)
    {
        $this->repository = $repository;
        $this->bus        = $bus;
    }


    public function __invoke(CreateCourseCommand $command)
    {
        $course = $this->repository->findById($command->id);
        if ($course == null) {
            $course = Course::create($command->id, $command->name);
        }
        $course->changeName($command->name);
        $this->repository->persist($course);
        $this->bus->publish(...$course->pullDomainEvents());
    }
}