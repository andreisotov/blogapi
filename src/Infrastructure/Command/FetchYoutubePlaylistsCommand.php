<?php

namespace BlogAPI\Infrastructure\Command;

use BlogAPI\Application\Handler\Category\CreateCategoryHandler;
use BlogAPI\Infrastructure\Services\FetchYoutubePlaylistsInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchYoutubePlaylistsCommand extends Command
{
	/**
	 * @var string
	 */
	protected static $defaultName = 'app:fetch-youtube-playlists';

	public const MAX_RESULTS = 50;

	public function __construct(
		private FetchYoutubePlaylistsInterface $fetchYoutubePlaylists,
		private CreateCategoryHandler $createCategoryHandler
	) {
		parent::__construct();
	}

	/**
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 * @return int
	 */
	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$playlists = $this->fetchYoutubePlaylists->fetch(
			[
				'params' => [
					'channelId'  => $input->getArgument('channelId'),
					'part'       => 'snippet,id',
					'maxResults' => $input->getArgument('maxResults') ?? self::MAX_RESULTS
				]
			]
		);

		foreach ($playlists as $playlist) {
			try {
				$this->createCategoryHandler->handle($playlist);
				$output->writeln($playlist['title'] . " playlist are saved.");
			} catch (Exception $e) {
				$output->writeln($e->getMessage());
			}
		}

		$output->writeln('Playlists are created');

		return Command::SUCCESS;
	}

	/**
	 * @return void
	 */
	protected function configure(): void
	{
		parent::configure();

		$this->addArgument('channelId', InputArgument::REQUIRED);
		$this->addArgument('maxResults', InputArgument::OPTIONAL);
	}
}
