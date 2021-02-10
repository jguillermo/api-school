<?php


namespace School\Enrollment\Application\FindByCourse;


use School\Enrollment\Application\ListEnrollmentResponse;
use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Enrollment\Application\EnrollmentResponse;
use School\Enrollment\Domain\Enrollment;
use School\Enrollment\Domain\EnrollmentRepository;
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