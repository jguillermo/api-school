<?php


namespace App\Student\Application;


use App\Student\Domain\StudentRepository;

class FindAllStudent
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute()
    {
        $students = $this->repository->findAll();
        $responses = [];
        foreach ($students as $student){
            $responses[]=new StudentResponse($student);
        }
        return $responses;
    }
}