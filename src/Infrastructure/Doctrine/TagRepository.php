<?php

namespace BlogAPI\Infrastructure\Doctrine;

use BlogAPI\Domain\Tags\Tag;
use BlogAPI\Domain\Tags\TagRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TagRepository extends ServiceEntityRepository implements TagRepositoryInterface
{
    public function __construct(
        private ManagerRegistry $registry
    ) {
        parent::__construct($registry, Tag::class);
    }

    public function tags(): array
    {
        return $this->findAll();
    }

    /**
     * @param string $slug
     *
     * @return \BlogAPI\Domain\Tags\Tag|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTagBySlug(string $slug): ?Tag
    {
        $qb = $this->createQueryBuilder("t");
        $qb->where("t.slug = :slug")
            ->setParameter('slug', $slug);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param \BlogAPI\Domain\Tags\Tag $tag
     *
     * @return void
     */
    public function save(Tag $tag): void
    {
        $this->registry->resetManager();
        $this->_em->persist($tag);
        $this->_em->flush();
    }

    /**
     * @param int $tagId
     * @param int $articleId
     *
     * @return void
     */
    public function saveRelations(int $tagId, int $articleId): void
    {
        $query       = "INSERT INTO `article_tag` SET `article_id` = :articleId, `tag_id` = :tagId";
        $queryParams = [
            "articleId"  => $articleId,
            "tagId" => $tagId,
        ];

        if ($this->getArticleTagDoubles($tagId, $articleId) === false) {
            // execure query and get result
            $this->registry->getConnection()
                ->executeQuery(
                    $query,
                    $queryParams
                );
        }

        // clear manager entities
        $this->registry->resetManager();
    }

    /**
     * @param int $tagId
     * @param int $articleId
     *
     * @return bool
     */
    public function getArticleTagDoubles(int $tagId, int $articleId): bool
    {
        $query       = "SELECT * FROM `article_tag` WHERE `article_id` = :articleId AND `tag_id` = :tagId";
        $queryParams = [
            "articleId"  => $articleId,
            "tagId" => $tagId,
        ];

        // execure query and get result
        $statement = $this->registry->getConnection()
            ->executeQuery(
                $query,
                $queryParams
            );

        return (bool)$statement->fetchAll();
    }
}
