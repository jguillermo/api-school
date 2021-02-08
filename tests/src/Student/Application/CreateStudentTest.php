<?php

namespace App\Tests\Student\Application;

use App\Student\Application\CreateStudent;
use App\Student\Domain\Student;
use App\Student\Domain\StudentRepository;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

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

        $service = new CreateStudent($mockRepository);
        $service->execute($studentId,'name');
    }
}
