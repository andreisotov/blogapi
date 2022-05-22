<?php

namespace Infrastructure\Doctrine;

use BlogAPI\Domain\Articles\Article;
use BlogAPI\Infrastructure\Doctrine\ArticleRepository;
use PHPUnit\Framework\TestCase;

class ArticleRepositoryTest extends TestCase
{
	public function testArticles()
	{
		$articles = [];

		for ($i = 1; $i <= 5; $i++) {
			$article = new Article();
			$article->setId($i);
			$article->setTitle('Article' . $i);
			$article->setSlug('article' . $i);
			$article->setDescription('Article description' . $i);
			$article->setYoutubeVideoId('asdjkhsdkjhsad' . $i);
			$article->setImage('/articles/article' . $i . '.png');

			$articles[] = $article;
		}

		$articleRepository = $this->createMock(ArticleRepository::class);

		$articleRepository->expects($this->any())
			->method('articles')
			->willReturn($articles);

		$this->assertCount(5, $articleRepository->articles());
	}

	public function testArticle()
	{
		$id = 1;

		$article = new Article();
		$article->setId($id);
		$article->setTitle('Article');
		$article->setSlug('article');
		$article->setDescription('Article description');
		$article->setYoutubeVideoId('asdjkhsdkjhsad');
		$article->setImage('/articles/article.png');

		$articleRepository = $this->createMock(ArticleRepository::class);

		$articleRepository->expects($this->any())
			->method('article')
			->willReturn($article);

		$this->assertEquals('article', $articleRepository->article($id)->getSlug());
	}
}
