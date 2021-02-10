<?php

namespace School\Student\Application\Delete;


use School\Shared\Domain\Bus\Command\CommandHandler;
use School\Student\Domain\StudentRepository;

class DeleteStudentByIdCommandHandler implements CommandHandler
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeleteStudentByIdCommand $command)
    {
        $this->repository->remove($command->id);
        return;
    }
}