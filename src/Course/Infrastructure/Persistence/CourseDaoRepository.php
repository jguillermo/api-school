<?php

namespace School\Course\Infrastructure\Persistence;

use School\Course\Domain\Course;
use School\Course\Domain\CourseRepository;
use School\Course\Infrastructure\Persistence\CourseDao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CourseDao|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourseDao|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourseDao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseDaoRepository extends ServiceEntityRepository implements CourseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourseDao::class);
    }

    // /**
    //  * @return CourseDao[] Returns an array of CourseDao objects
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
    public function findOneBySomeField($value): ?CourseDao
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function persist(Course $Course): void
    {
        $CourseDao = $this->find($Course->id());
        if ($CourseDao == null) {
            $CourseDao = new CourseDao($Course);
        }else{
            $CourseDao->setEntity($Course);
        }
        $this->getEntityManager()->persist($CourseDao);
        $this->getEntityManager()->flush();
    }

    public function findById(string $id): ?Course
    {
        $CourseDao = $this->find($id);
        if ($CourseDao == null) {
            return null;
        }
        return $CourseDao->toEntity();
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
        $CourseDao = $this->find($id);
        if ($CourseDao !== null) {
            $this->getEntityManager()->remove($CourseDao);
            $this->getEntityManager()->flush();
        }

    }
}
