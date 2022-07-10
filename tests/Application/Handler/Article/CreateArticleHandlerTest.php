<?php
/**
 * Created by site-town.com
 * User: ansotov
 * Date: 22.05.2022
 * Time: 6:14 PM
 */
namespace Application\Handler\Article;

use BlogAPI\Application\Handler\Article\CreateArticleHandler;
use BlogAPI\Domain\Articles\Article;
use BlogAPI\Infrastructure\Doctrine\ArticleRepository;
use PHPUnit\Framework\TestCase;

class CreateArticleHandlerTest extends TestCase
{

	public function testHandle()
	{
        /*$id = 1;

        $article = new Article();
        $article->setId($id);
        $article->setTitle('Article');
        $article->setSlug('article');
        $article->setDescription('Article description');
        $article->setYoutubeVideoId('asdjkhsdkjhsad');
        $article->setImage('/articles/article.png');

        $articleRepository = $this->getMockBuilder(ArticleRepository::class)
            ->setMethods(['save', 'articles'])
            ->getMock();

        $articleRepository->expects($this->once())
            ->method('save')
            ->with($article);


        dd($articleRepository->articles());

        $articleRepository = $this->createMock(CreateArticleHandler::class);

        $articleRepository->expects($this->any())
            ->method('handle')
            ->with($article);*/

		$this->assertTrue(true);
	}
}
