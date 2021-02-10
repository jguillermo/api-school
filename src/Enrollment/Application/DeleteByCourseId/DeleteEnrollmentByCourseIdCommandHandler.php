<?php


namespace School\Enrollment\Application\DeleteByCourseId;

use School\Shared\Domain\Bus\Command\CommandHandler;
use School\Enrollment\Domain\Enrollment;
use School\Enrollment\Domain\EnrollmentRepository;

class DeleteEnrollmentByCourseIdCommandHandler implements CommandHandler
{
    private $repository;

    public function __construct(EnrollmentRepository $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(DeleteEnrollmentByCourseIdCommand $command)
    {

        $this->repository->deleteAllByCourseId($command->courseId);
    }
}