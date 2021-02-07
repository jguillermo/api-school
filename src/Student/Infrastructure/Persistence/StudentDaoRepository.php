<?php

namespace App\Student\Infrastructure\Persistence;

use App\Student\Domain\Student;
use App\Student\Domain\StudentRepository;
use App\Student\Infrastructure\Persistence\StudentDao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudentDao|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentDao|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentDao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentDaoRepository extends ServiceEntityRepository implements StudentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentDao::class);
    }

    // /**
    //  * @return StudentDao[] Returns an array of StudentDao objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StudentDao
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function persist(Student $student): void
    {
        $studentDao = $this->find($student->id());
        if ($studentDao == null) {
            $studentDao = new StudentDao($student);
        }else{
            $studentDao->setEntity($student);
        }
        $this->getEntityManager()->persist($studentDao);
        $this->getEntityManager()->flush();
    }

    public function findById(string $id): ?Student
    {
        $studentDao = $this->find($id);
        if ($studentDao == null) {
            return null;
        }
        return $studentDao->toEntity();
    }

    public function findAll()
    {
        $list = [];
        foreach ($this->findBy([]) as $dao) {
            $list[] = $dao->toEntity();
        }
        return $list;
    }

    public function remove(string $id): void
    {
        $studentDao = $this->find($id);
        if ($studentDao !== null) {
            $this->getEntityManager()->remove($studentDao);
            $this->getEntityManager()->flush();
        }

    }
}
