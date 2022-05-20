<?php

namespace BlogAPI\Infrastructure\Services;

use Symfony\Component\String\Slugger\AsciiSlugger;

class FetchYoutubePlaylists implements FetchYoutubePlaylistsInterface
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
		$playlists = $this->provider->getContent($input);

		$playlistArray = [];

		foreach ($playlists['items'] as $playlist) {
			if ($playlist['id']['kind'] === 'youtube#playlist') {
				$playlistArray[] = $this->playlist($playlist);
			}
		}

		return $playlistArray;
	}

	/**
	 * @param array $playlist
	 *
	 * @return array
	 */
	private function playlist(array $playlist): array
	{
		return [
			'title'               => $playlist['snippet']['title'],
			'slug'                => strtolower((new AsciiSlugger())->slug($playlist['snippet']['title'])->toString()),
			'description'         => $playlist['snippet']['description'],
			'youtube_playlist_id' => $playlist['id']['playlistId'],
			'image'               => $playlist['snippet']['thumbnails']['high']['url'],
			'active'              => self::DEFAULT_ACTIVE,
		];
	}
}
