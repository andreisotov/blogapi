<?php

namespace BlogAPI\Infrastructure\Services;

use BlogAPI\Infrastructure\Formatters\FormatterInterface;
use BlogAPI\Infrastructure\Formatters\YoutubeVideoFormatter;

class FetchYoutubeVideos implements FetchYoutubeVideosInterface
{
	public function __construct(
		private ProviderInterface $provider,
		private YoutubeVideoFormatter $youtubeVideoFormatter
	) {
	}

	/**
	 * @param array $input
	 *
	 * @return array
	 */
	public function fetch(array $input = []): array
	{
		$videos = $this->provider->getContent($input);

		$videoArray = [];

		foreach ($videos['items'] as $video) {
			if ($video['id']['kind'] === 'youtube#video') {
				$videoArray[] = $this->youtubeVideoFormatter->formatted($video);
			}
		}

		return $videoArray;
	}
}
