<?php


namespace School\Student\Application\Create;


use School\Shared\Domain\Bus\Command\CommandHandler;
use School\Student\Domain\Student;
use School\Student\Domain\StudentRepository;

class CreateStudentCommandHandler implements CommandHandler
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(CreateStudentCommand $command)
    {
        $student = $this->repository->findById($command->id);
        if ($student == null) {
            $student = Student::create($command->id, $command->name);
        }
        $student->changeName($command->name);
        $this->repository->persist($student);
    }
}