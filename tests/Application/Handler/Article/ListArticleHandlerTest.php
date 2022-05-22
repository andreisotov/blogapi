<?php
/**
 * Created by site-town.com
 * User: ansotov
 * Date: 22.05.2022
 * Time: 10:12 PM
 */
namespace Application\Handler\Article;

use BlogAPI\Application\Handler\Article\ListArticleHandler;
use BlogAPI\Domain\Articles\Article;
use BlogAPI\Infrastructure\Doctrine\ArticleRepository;
use PHPUnit\Framework\TestCase;

class ListArticleHandlerTest extends TestCase
{

	public function testHandle()
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

		$listArticleHandler = $this->createMock(ListArticleHandler::class);

		$listArticleHandler->expects($this->any())
			->method('handle')
			->willReturn($articles);

		$this->assertCount(5, $listArticleHandler->handle());
	}
}
