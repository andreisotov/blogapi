<?php

namespace BlogAPI\Infrastructure\Services;

use Symfony\Component\String\Slugger\AsciiSlugger;

class FetchYoutubeVideos implements FetchYoutubeVideosInterface
{
	private const DEFAULT_ACTIVE = 1;

	/**
	 * @var \BlogAPI\Infrastructure\Services\ProviderInterface
	 */
	private ProviderInterface $provider;

	/**
	 * @param \BlogAPI\Infrastructure\Services\ProviderInterface $provider
	 */
	public function __construct(ProviderInterface $provider)
	{
		$this->provider = $provider;
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
				$videoArray[] = $this->video($video);
			}
		}

		return $videoArray;
	}


	/**
	 * @param array $video
	 *
	 * @return array
	 */
	private function video(array $video): array
	{
		return [
			'title'            => $video['snippet']['title'],
			'slug'             => strtolower((new AsciiSlugger())->slug($video['snippet']['title'])->toString()),
			'description'      => $video['snippet']['description'],
			'youtube_video_id' => $video['id']['videoId'],
			'image'            => $video['snippet']['thumbnails']['high']['url'],
			'active'           => self::DEFAULT_ACTIVE,
			'publish_at'       => $video['snippet']['publishedAt'],
		];
	}
}
