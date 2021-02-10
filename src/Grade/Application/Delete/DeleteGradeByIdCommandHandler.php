<?php

namespace School\Grade\Application\Delete;


use School\Shared\Domain\Bus\Command\CommandHandler;
use School\Grade\Domain\GradeRepository;

class DeleteGradeByIdCommandHandler implements CommandHandler
{
    private $repository;

    public function __construct(GradeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeleteGradeByIdCommand $command)
    {
        $this->repository->remove($command->id);
        return;
    }
}