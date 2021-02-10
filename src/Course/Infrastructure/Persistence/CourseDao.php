<?php

namespace School\Course\Infrastructure\Persistence;

use School\Course\Infrastructure\Persistence\CourseDaoRepository;
use School\Course\Domain\Course;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CourseDaoRepository::class)
 * @ORM\Table(name="course")
 */
class CourseDao
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;


    public function __construct(Course $Course)
    {
        $this->setEntity($Course);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated): void
    {
        $this->updated = $updated;
    }



    public function toEntity():Course
    {
        return new Course($this->id,$this->name);
    }

    public function setEntity(Course $Course)
    {
        $this->id = $Course->id();
        $this->name = $Course->name();
        $this->updated = new DateTime();
    }
}
