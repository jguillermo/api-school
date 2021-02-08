<?php


namespace App\Enrollment\Application\FindStudent;


use App\Enrollment\Application\ListEnrollmentResponse;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Enrollment\Application\EnrollmentResponse;
use App\Enrollment\Domain\Enrollment;
use App\Enrollment\Domain\EnrollmentRepository;
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