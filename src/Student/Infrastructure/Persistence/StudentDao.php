<?php

namespace School\Student\Infrastructure\Persistence;

use School\Student\Infrastructure\Persistence\StudentDaoRepository;
use School\Student\Domain\Student;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentDaoRepository::class)
 * @ORM\Table(name="student")
 */
class StudentDao
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


    public function __construct(Student $student)
    {
        $this->setEntity($student);
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



    public function toEntity():Student
    {
        return new Student($this->id,$this->name);
    }

    public function setEntity(Student $student)
    {
        $this->id = $student->id();
        $this->name = $student->name();
        $this->updated = new DateTime();
    }
}
