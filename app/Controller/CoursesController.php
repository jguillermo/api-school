<?php

namespace App\Controller;


use School\Course\Application\Create\CreateCourseCommand;
use School\Course\Application\Delete\DeleteCourseByIdCommand;
use School\Course\Application\FindAll\FindAllCourseQuery;
use School\Course\Application\FindCourse\FindCourseByIdQuery;
use School\Course\Application\ListCourseResponse;
use School\Shared\Domain\Bus\Command\CommandBus;
use School\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/courses")
 */
class CoursesController extends AbstractController
{

    private $commandBus;
    private $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }


    /**
     * @Route("/{courseId}", methods={"GET"})
     */
    public function getById(string $courseId)
    {
        try {
            return $this->json(
                $this->queryBus->ask(new FindCourseByIdQuery($courseId))
            );
        } catch (NotFoundHttpException $exception) {
            return $this->json([
                'error' => $exception->getMessage()
            ], 404);
        }
    }

    /**
     * @Route("", methods={"GET"})
     */
    public function getAll()
    {
        /** @var ListCourseResponse $response */
        $response = $this->queryBus->ask(new FindAllCourseQuery());
        return $this->json($response->courses);
    }

    /**
     * @Route("/{courseId}", methods={"PUT"})
     */
    public function create(string $courseId, Request $request)
    {
        $this->commandBus->dispatch(
            new CreateCourseCommand(
                $courseId,
                $request->request->get('name', '')
            )
        );
        return new Response('', Response::HTTP_CREATED);

    }


    /**
     * @Route("/{courseId}", methods={"DELETE"})
     */
    public function deleteById(string $courseId)
    {
        $this->commandBus->dispatch(
            new DeleteCourseByIdCommand(
                $courseId
            )
        );
        return new Response('', Response::HTTP_OK);

    }
}