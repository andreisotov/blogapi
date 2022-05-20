<?php

namespace BlogAPI\Infrastructure\Command;

use BlogAPI\Infrastructure\Services\FetchYoutubeVideosInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchYoutubeVideosCommand extends Command
{
	protected static $defaultName = 'app:fetch-youtube-videos';
	const MAX_RESULTS = 50;

	public function __construct(
		private FetchYoutubeVideosInterface $fetchYoutubeVideos,
		//private CreateArticleHandler $createArticleHandler
	)
	{
		parent::__construct();
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return int
	 */
	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$videos = $this->fetchYoutubeVideos->fetch(
			[
				'params' => [
					'channelId' => $input->getArgument('channelId'),
					'part' => 'snippet,id',
					'maxResults' => $input->getArgument('maxResults') ?? self::MAX_RESULTS
				]
			]
		);

		dd($videos);
		foreach ($videos as $video) {
			/*try {
				$this->createGameHandler->handle($game);
				$output->writeln($game['homeTeam'].'-'.$game['awayTeam']." games are saved.");
			} catch (Exception $e) {
				$output->writeln($e->getMessage());
			}*/
		}

		$output->writeln('Games are created');

		return Command::SUCCESS;
	}

	protected function configure()
	{
		parent::configure();

		$this->addArgument('channelId', InputArgument::REQUIRED);
		$this->addArgument('maxResults', InputArgument::OPTIONAL);
	}
}
