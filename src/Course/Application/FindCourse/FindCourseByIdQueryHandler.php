<?php


namespace School\Course\Application\FindCourse;


use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Course\Application\CourseResponse;
use School\Course\Domain\Course;
use School\Course\Domain\CourseRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FindCourseByIdQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindCourseByIdQuery $query): CourseResponse
    {
        $Course = $this->repository->findById($query->id);
        if($Course == null){
            throw new NotFoundHttpException("Course not found");
        }
        return new CourseResponse($Course);
    }
}