<?php

namespace BlogAPI\Infrastructure\Command;

use BlogAPI\Application\Handler\Category\CreateCategoryHandler;
use BlogAPI\Infrastructure\Services\FetchYoutubePlaylistsServiceInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class FetchYoutubePlaylistsCommand extends Command
{
	/**
	 * @var string
	 */
	protected static $defaultName = 'app:fetch-youtube-playlists';

	private const MAX_RESULTS = 50;

	public function __construct(
		private FetchYoutubePlaylistsServiceInterface $fetchYoutubePlaylists,
		private CreateCategoryHandler $createCategoryHandler,
		private ContainerBagInterface $params,
	) {
		parent::__construct();
	}

	/**
	 * @param \Symfony\Component\Console\Input\InputInterface   $input
	 * @param \Symfony\Component\Console\Output\OutputInterface $output
	 *
	 * @return int
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$playlists = $this->fetchYoutubePlaylists->fetch(
			[
				'channelId' => $this->params->get('google_api.youtube.channel_id'),
				'maxResults' => $input->getArgument('maxResults') ?? self::MAX_RESULTS
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

		$this->addArgument('maxResults', InputArgument::OPTIONAL);
	}
}
