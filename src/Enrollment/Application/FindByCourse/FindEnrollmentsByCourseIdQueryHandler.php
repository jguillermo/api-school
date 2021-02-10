<?php


namespace App\Enrollment\Application\FindByCourse;


use App\Enrollment\Application\ListEnrollmentResponse;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Enrollment\Application\EnrollmentResponse;
use App\Enrollment\Domain\Enrollment;
use App\Enrollment\Domain\EnrollmentRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FindEnrollmentsByCourseIdQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(EnrollmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindEnrollmentsByCourseIdQuery $query): ListEnrollmentStudentResponse
    {
        $enrollments = $this->repository->findByCourse($query->courseId);
        $students = [];
        foreach ($enrollments as $enrollment) {
            $students[] = $enrollment->studentId();
        }
        return new ListEnrollmentStudentResponse($students);
    }
}