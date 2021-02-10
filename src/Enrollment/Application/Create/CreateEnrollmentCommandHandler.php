<?php


namespace School\Enrollment\Application\Create;


use School\Shared\Domain\Bus\Command\CommandHandler;
use School\Enrollment\Domain\Enrollment;
use School\Enrollment\Domain\EnrollmentRepository;

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