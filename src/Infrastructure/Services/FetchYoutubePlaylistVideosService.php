<?php

namespace BlogAPI\Infrastructure\Services;

use BlogAPI\Infrastructure\ExternalAPI\Youtube\YoutubePlaylistItems;
use BlogAPI\Infrastructure\Formatters\YoutubePlaylistVideoFormatter;
use BlogAPI\Infrastructure\Services\Interfaces\FetchServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class FetchYoutubePlaylistVideosService implements FetchServiceInterface
{
	private Collection $collection;

	public function __construct(
		private YoutubePlaylistItems $provider,
		private YoutubePlaylistVideoFormatter $youtubePlaylistVideoFormatter,
        private FetchYoutubeVideoService $fetchYoutubeVideoService
	) {
	}

	/**
	 * @param array $input
	 * Tag problem is here
	 * @return \Doctrine\Common\Collections\Collection
	 * @throws \Exception
	 */
	public function fetch(array $input = []): Collection
	{
		$videos = $this->provider->getContent($input);

		$this->collection = new ArrayCollection();
		foreach ($videos['items'] as $video) {
            $videoItem = $this->fetchYoutubeVideoService->fetch(['id' => $video->getSnippet()->getResourceId()->getVideoId()]);
			$this->collection->add($this->youtubePlaylistVideoFormatter->formatted($videoItem));
		}

		return $this->collection;
	}
}
