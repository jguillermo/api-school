<?php


namespace School\Course\Application\FindAll;


use School\Shared\Domain\Bus\Query\QueryHandler;
use School\Course\Application\ListCourseResponse;
use School\Course\Application\CourseResponse;
use School\Course\Domain\CourseRepository;

class FindAllCourseQueryHandler implements QueryHandler
{
    private $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindAllCourseQuery $query): ListCourseResponse
    {
        $Courses = $this->repository->findAll();
        $responses = [];
        foreach ($Courses as $Course){
            $responses[]=new CourseResponse($Course);
        }
        return new ListCourseResponse($responses);
    }
}