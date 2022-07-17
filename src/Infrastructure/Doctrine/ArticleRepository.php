<?php

namespace BlogAPI\Infrastructure\Doctrine;

use BlogAPI\Domain\Articles\Article;
use BlogAPI\Domain\Articles\ArticleRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 */
class ArticleRepository extends ServiceEntityRepository implements ArticleRepositoryInterface
{
    /**
     * @param \Doctrine\Persistence\ManagerRegistry $registry
     */
    public function __construct(
        private ManagerRegistry $registry
    ) {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param string $slug
     *
     * @return \BlogAPI\Domain\Articles\Article|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function article(string $slug): ?Article
    {
        $qb = $this->createQueryBuilder("a");
        $qb->where("a.slug = :slug and a.active = 1")
            ->setParameter('slug', $slug);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @return array
     */
    public function articles(): array
    {
        $qb = $this->createQueryBuilder("a");
        $qb->where("a.active = 1");

        return $qb->getQuery()->getResult();
    }

    /**
     * @param \BlogAPI\Domain\Articles\Article $article
     *
     * @return array
     */
    public function getTags(Article $article): array
    {
        $tags = [];

        foreach ($article->getTags() as $key => $tag) {
            $tags[$key]['id']    = $tag->getId();
            $tags[$key]['title'] = $tag->getTitle();
            $tags[$key]['slug']  = $tag->getSlug();
        }

        return $tags;
    }

    /**
     * @param \BlogAPI\Domain\Articles\Article $article
     *
     * @return array
     */
    public function getCategories(Article $article): array
    {
        $categories = [];

        foreach ($article->getCategories() as $key => $category) {
            if (!$category->isActive()) {
                continue;
            }
            $categories[$key]['id']          = $category->getId();
            $categories[$key]['title']       = $category->getTitle();
            $categories[$key]['slug']        = $category->getSlug();
            $categories[$key]['description'] = $category->getSlug() ?? '';
            $categories[$key]['created_at']  = $category->getCreatedAt() ?? '';
            $categories[$key]['updated_at']  = $category->getUpdatedAt() ?? '';
        }

        return $categories;
    }

    /**
     * @param string $slug
     *
     * @return \BlogAPI\Domain\Articles\Article|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getArticleBySlug(string $slug): ?Article
    {
        $qb = $this->createQueryBuilder("a");
        $qb->where("a.slug = :slug")
            ->setParameter('slug', $slug);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param string $youtubeVideoId
     *
     * @return \BlogAPI\Domain\Articles\Article|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getArticleByYoutubeVideoId(string $youtubeVideoId): ?Article
    {
        $qb = $this->createQueryBuilder("a");
        $qb->where("a.youtubeVideoId = :youtube_video_id")
            ->setParameter('youtube_video_id', $youtubeVideoId);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param \BlogAPI\Domain\Articles\Article $article
     *
     * @return void
     */
    public function save(Article $article): void
    {
        $this->registry->resetManager();
        $this->_em->persist($article);
        $this->_em->flush();
    }

    /**
     * @param int $articleId
     * @param int $categoryId
     *
     * @return void
     */
    public function saveRelations(int $articleId, int $categoryId): void
    {
        $query       = "INSERT INTO `article_category` SET `article_id` = :articleId, `category_id` = :categoryId";
        $queryParams = [
            "articleId"  => $articleId,
            "categoryId" => $categoryId,
        ];

        if ($this->getArticleCategoryDoubles($articleId, $categoryId) === false) {
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
    public function getArticleCategoryDoubles(int $articleId, int $categoryId): bool
    {
        $query       = "SELECT * FROM `article_category` WHERE `article_id` = :articleId AND `category_id` = :categoryId";
        $queryParams = [
            "articleId"  => $articleId,
            "categoryId" => $categoryId,
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
