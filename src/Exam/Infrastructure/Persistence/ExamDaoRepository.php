<?php

namespace App\Exam\Infrastructure\Persistence;

use App\Exam\Domain\Exam;
use App\Exam\Domain\ExamRepository;
use App\Exam\Infrastructure\Persistence\ExamDao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExamDao|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamDao|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamDao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamDaoRepository extends ServiceEntityRepository implements ExamRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamDao::class);
    }

    public function persist(Exam $exam): void
    {
        $examDao = $this->find($exam->id());
        if ($examDao == null) {
            $examDao = new ExamDao($exam);
        }else{
            $examDao->setEntity($exam);
        }
        $this->getEntityManager()->persist($examDao);
        $this->getEntityManager()->flush();
    }

    public function findById(string $id): ?Exam
    {
        $examDao = $this->find($id);
        if ($examDao == null) {
            return null;
        }
        return $examDao->toEntity();
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
        $examDao = $this->find($id);
        if ($examDao !== null) {
            $this->getEntityManager()->remove($examDao);
            $this->getEntityManager()->flush();
        }

    }

    public function findAllByCourseId($courseId)
    {
        $list = [];
        foreach ($this->findBy(['courseId'=>$courseId]) as $dao) {
            $list[] = $dao->toEntity();
        }
        return $list;
    }
}
