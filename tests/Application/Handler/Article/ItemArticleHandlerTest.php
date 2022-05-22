<?php
/**
 * Created by site-town.com
 * User: ansotov
 * Date: 22.05.2022
 * Time: 10:15 PM
 */
namespace Application\Handler\Article;

use BlogAPI\Application\Handler\Article\ItemArticleHandler;
use BlogAPI\Domain\Articles\Article;
use BlogAPI\Infrastructure\Doctrine\ArticleRepository;
use PHPUnit\Framework\TestCase;

class ItemArticleHandlerTest extends TestCase
{

	public function testHandle()
	{
		$id = 1;

		$article = new Article();
		$article->setId($id);
		$article->setTitle('Article');
		$article->setSlug('article');
		$article->setDescription('Article description');
		$article->setYoutubeVideoId('asdjkhsdkjhsad');
		$article->setImage('/articles/article.png');

		$itemArticleHandler = $this->createMock(ItemArticleHandler::class);

		$itemArticleHandler->expects($this->any())
			->method('handle')
			->willReturn($article);

		$this->assertEquals('article', $itemArticleHandler->handle($id)->getSlug());
	}
}
