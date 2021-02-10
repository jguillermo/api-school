<?php

namespace School\Tests\Student\Application;

use School\Student\Application\Create\CreateStudentCommand;
use School\Student\Application\Create\CreateStudentCommandHandler;
use School\Student\Application\CreateStudent;
use School\Student\Domain\Student;
use School\Student\Domain\StudentRepository;
use School\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

class CreateStudentTest extends UnitTestCase
{
    /**
     * al no tener value object, ni cqrs, los test unitarios no ayudan mucho,
     * para este caso es mejor usar los test E2e con behat
     */
    public function testCreateStudent()
    {
        $studentId = "5dc592c0-7272-444f-a72a-d795eb6dde9c";
        $mockRepository = $this->mock(StudentRepository::class);
        $mockRepository->shouldReceive('findById')->andReturn(Student::create($studentId,"name"));
        $mockRepository->shouldReceive('persist')->andReturn(null);

        $service = new CreateStudentCommandHandler($mockRepository);
        $service(new CreateStudentCommand($studentId,'name'));
    }
}
