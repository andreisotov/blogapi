<?php

namespace BlogAPI\Infrastructure\Command;

use BlogAPI\Application\Handler\Category\CreateCategoryHandler;
use BlogAPI\Infrastructure\Services\FetchYoutubePlaylistsService;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class FetchYoutubeChannelCommand extends Command
{
	/**
	 * @var string
	 */
	protected static $defaultName = 'app:fetch-youtube-channel';

	private const MAX_RESULTS = 50;

	public function __construct(
		private FetchYoutubePlaylistsService $fetchYoutubePlaylists,
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

        $progressBar = new ProgressBar($output);
        $progressBar->setBarCharacter('<fg=green>•</>');
        $progressBar->setEmptyBarCharacter('<fg=green>⚬</>');
        $progressBar->setProgressCharacter('<fg=green>➤</>');
        $progressBar->setFormat('verbose');
        $progressBar->start(count($playlists));

        $success = $errors = 0;

		foreach ($playlists as $playlist) {
            $this->createCategoryHandler->handle($playlist);
            $success++;
            $progressBar->advance();
		}

		$output->writeln(PHP_EOL . 'Youtube channel data obtained');
		$output->writeln( 'Success: ' . $success . ' items.');
		$output->writeln('Errors (can be doubles): ' . $errors . ' items.');

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
