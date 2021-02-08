<?php


namespace App\Enrollment\Application\Create;


use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Enrollment\Domain\Enrollment;
use App\Enrollment\Domain\EnrollmentRepository;

class CreateEnrollmentCommandHandler implements CommandHandler
{
    private $repository;

    public function __construct(EnrollmentRepository $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(CreateEnrollmentCommand $command)
    {
        $enrollment = Enrollment::create($command->courseId, $command->studentId);
        $this->repository->persist($enrollment);
    }
}