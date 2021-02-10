<?php


namespace School\Enrollment\Application\FindStudent;


use School\Enrollment\Application\ListEnrollmentResponse;
use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Enrollment\Application\EnrollmentResponse;
use School\Enrollment\Domain\Enrollment;
use School\Enrollment\Domain\EnrollmentRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FindEnrollmentsByStudentIdQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(EnrollmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindEnrollmentsByStudentIdQuery $query): ListEnrollmentResponse
    {
        $enrollments = $this->repository->findByStudentId($query->id);
        $responses = [];

        foreach ($enrollments as $enrollment) {
            $responses[] = new EnrollmentResponse($enrollment['name'], $enrollment['id']);
        }
        return new ListEnrollmentResponse($responses);
    }
}