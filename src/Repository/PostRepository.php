<?php

namespace NormaUy\Bundle\NormaCMSBundle\Repository;

use NormaUy\Bundle\NormaCMSBundle\Entity\Post;
use DateTime;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Post[] Returns an array of Post objects
     */
    public function findByDate(
        DateTimeImmutable $date = new DateTime('now'),
        ?int $maxResults = 6,
        ?Post $postException = null,
    ): array {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.publishedAt <= :date')
            ->setParameter('date', "{$date->format('Y-m-d')} 23:59:59")
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.id', 'DESC');

        if ($maxResults !== null) {
            $qb->setMaxResults($maxResults);
        }

        if ($postException !== null) {
            $qb->andWhere('p.id <> :postException')->setParameter('postException', $postException->getId());
        }

        return $qb->getQuery()->getResult();
    }

    public function findOneBySlug(string $slug, string $publishedAt = null): ?Post
    {
        $qb = $this->createQueryBuilder('p');

        $qb->where($qb->expr()->eq('p.slug', ':slug'))
            ->orderBy('p.publishedAt', 'DESC')
            ->addOrderBy('p.id', 'DESC')
            ->setParameter('slug', $slug);

        if ($publishedAt) {
            $publishedAt = new \DateTime($publishedAt);
            $qb->andWhere($qb->expr()->gt('p.publishedAt', ':publishedAt'))->setParameter('publishedAt', $publishedAt);
        }

        $result = $qb->getQuery()->getOneOrNullResult();

        if (!$result) {
            return null;
        }

        return $result;
    }
}
