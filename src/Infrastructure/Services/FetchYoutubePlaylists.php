<?php

namespace BlogAPI\Infrastructure\Services;

use BlogAPI\Infrastructure\Formatters\YoutubePlaylistFormatter;

class FetchYoutubePlaylists implements FetchYoutubePlaylistsInterface
{
	public function __construct(
		private ProviderInterface $provider,
		private YoutubePlaylistFormatter $youtubePlaylistFormatter
	) {
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
				$playlistArray[] = $this->youtubePlaylistFormatter->formatted($playlist);
			}
		}

		return $playlistArray;
	}
}
