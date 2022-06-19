<?php

namespace BlogAPI\Infrastructure\Services;

use BlogAPI\Infrastructure\ExternalAPI\Youtube\YoutubePlaylists;
use BlogAPI\Infrastructure\Formatters\YoutubePlaylistFormatter;

class FetchYoutubePlaylistsService implements FetchYoutubePlaylistsServiceInterface
{
	public function __construct(
		private YoutubePlaylists $provider,
		private YoutubePlaylistFormatter $youtubePlaylistFormatter,
		private FetchYoutubePlaylistVideos $playlistVideos
	) {
	}

	/**
	 * @param array $input
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function fetch(array $input = []): array
	{
		$playlists = $this->provider->getContent($input);

		$playlistArray = [];

		foreach ($playlists['items'] as $playlist) {

			$playlistItem = $this->youtubePlaylistFormatter->formatted($playlist);
			$playlistItem['articles'] = $this->playlistVideos->fetch(['playlistId' => $playlistItem['youtube_playlist_id']]);
			$playlistArray[] = $playlistItem;
		}

		return $playlistArray;
	}
}
