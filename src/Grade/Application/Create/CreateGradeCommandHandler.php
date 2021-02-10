<?php


namespace App\Grade\Application\Create;


use App\Grade\Domain\Exam;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Grade\Domain\Grade;
use App\Grade\Domain\GradeRepository;

class CreateGradeCommandHandler implements CommandHandler
{
    private $repository;

    public function __construct(GradeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateGradeCommand $command)
    {
        $grade = $this->repository->findById($command->id);
        if ($grade !== null) {
            return;
        }
        $grade = Grade::create($command->id, $command->grade, new Exam($command->examId, $command->studentId, $command->courseId));
        $this->repository->persist($grade);

    }
}