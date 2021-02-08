<?php


namespace App\Enrollment\Application\DeleteByCourseId;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Enrollment\Domain\Enrollment;
use App\Enrollment\Domain\EnrollmentRepository;

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