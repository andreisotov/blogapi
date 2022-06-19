<?php

namespace BlogAPI\Infrastructure\Services;

use BlogAPI\Infrastructure\ExternalAPI\Youtube\YoutubePlaylistItems;
use BlogAPI\Infrastructure\Formatters\YoutubePlaylistVideoFormatter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class FetchYoutubePlaylistVideos implements FetchYoutubePlaylistVideosInterface
{
	private Collection $collection;

	public function __construct(
		private YoutubePlaylistItems $provider,
		private YoutubePlaylistVideoFormatter $youtubePlaylistVideoFormatter
	) {
	}

	/**
	 * @param array $input
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 * @throws \Exception
	 */
	public function fetch(array $input = []): Collection
	{
		$videos = $this->provider->getContent($input);

		$this->collection = new ArrayCollection();
		foreach ($videos['items'] as $video) {
			$this->collection->add($this->youtubePlaylistVideoFormatter->formatted($video));
		}

		return $this->collection;
	}
}
