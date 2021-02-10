<?php

namespace App\Controller;


use School\Grade\Application\FindAllStudent\FindAllGradesByStudentQuery;
use School\Grade\Application\ListGradeResponse;
use School\Shared\Domain\Bus\Command\CommandBus;
use School\Shared\Domain\Bus\Query\QueryBus;
use School\Student\Application\ListStudentResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/students/{studentId}/grades")
 */
class StudentGradeController extends AbstractController
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
    public function getAll(string $studentId)
    {
        /** @var ListGradeResponse $response */
        $response = $this->queryBus->ask(new FindAllGradesByStudentQuery($studentId));
        return $this->json($response->grades);
    }

}