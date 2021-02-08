<?php

namespace App\Controller;


use App\Enrollment\Application\FindStudent\FindEnrollmentsByStudentIdQuery;
use App\Enrollment\Application\ListEnrollmentResponse;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Student\Application\FindAll\FindAllStudentQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/students/{studentId}/enrollments")
 */
class EnrollmentController extends AbstractController
{

    private $commandBus;
    private $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }


    /**
     * @Route("", methods={"GET"})
     */
    public function getEnrollmentByStudent(string $studentId)
    {
        /** @var ListEnrollmentResponse $response */
        $response = $this->queryBus->ask(new FindEnrollmentsByStudentIdQuery($studentId));
        return $this->json($response->enrollments);

    }
}