<?php

namespace BlogAPI\Infrastructure\Services;

use Symfony\Component\String\Slugger\AsciiSlugger;

class FetchYoutubeVideos implements FetchYoutubeVideosInterface
{
	private const DEFAULT_ACTIVE = 1;

	private ProviderInterface $provider;

	public function __construct(ProviderInterface $provider)
	{
		$this->provider = $provider;
	}

	public function fetch(array $input = []): array
	{
		$videos = $this->provider->getContent($input);

		$videoArray = [];

		foreach ($videos['items'] as $video) {
			if ($video['id']['kind'] === 'youtube#video') {
				$videoArray['videos'][] = $this->video($video);
			}

			if ($video['id']['kind'] === 'youtube#playlist') {
				$videoArray['playlists'][] = $this->category($video);
			}
		}

		return $videoArray;
	}


	private function video(array $video): array
	{
		return [
			'title'            => $video['snippet']['title'],
			'slug'             => strtolower((new AsciiSlugger())->slug($video['snippet']['title'])->toString()),
			'description'      => $video['snippet']['description'],
			'youtube_video_id' => $video['id']['videoId'],
			'image'            => $video['snippet']['thumbnails']['high']['url'],
			'active'           => self::DEFAULT_ACTIVE,
		];
	}

	private function category(array $video): array
	{
		return [
			'title'               => $video['snippet']['title'],
			'slug'                => strtolower((new AsciiSlugger())->slug($video['snippet']['title'])->toString()),
			'description'         => $video['snippet']['description'],
			'youtube_playlist_id' => $video['id']['playlistId'],
			'image'               => $video['snippet']['thumbnails']['high']['url'],
			'active'              => self::DEFAULT_ACTIVE,
		];
	}
}
