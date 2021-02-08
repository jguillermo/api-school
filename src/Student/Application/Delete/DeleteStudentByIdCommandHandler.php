<?php

namespace App\Student\Application\Delete;


use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Student\Domain\StudentRepository;

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