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

	/*public function testMy()
	{
		$player = new Player();
		$player->setUsername('fmo');

		$game = new Game();

		$homeTeam = new Team();
		$homeTeam->setName('Liverpool');

		$awayTeam = new Team();
		$awayTeam->setName('Arsenal');

		$game->setId(333);
		$game->setGameTime(new DateTimeImmutable('tomorrow'));
		$game->setHomeTeam($homeTeam);
		$game->setAwayTeam($awayTeam);

		$playerRepository = new PlayerRepository();
		$playerRepository->save($player);

		$gameRepository = new GameRepository();
		$gameRepository->save($game);

		$makeAGuess = new MakeGuessHandler($playerRepository, $gameRepository);
		$makeAGuess->handle([
			'username' => 'fmo',
			'gameId'   => 333,
			'guess'    => '4-4'
		]);

		$makeAGuess->handle([
			'username' => 'fmo',
			'gameId'   => 323,
			'guess'    => '4-4'
		]);

		$this->assertEquals('4-4', $player->getGuess($game)->getGuess());
	}*/
}
