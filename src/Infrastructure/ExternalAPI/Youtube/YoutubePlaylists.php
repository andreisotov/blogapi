<?php

namespace BlogAPI\Infrastructure\ExternalAPI\Youtube;

use BlogAPI\Infrastructure\Services\ProviderInterface;
use Exception;

class YoutubePlaylists implements ProviderInterface
{
	use YoutubeApiClient;

	/**
	 * @param array $criteria
	 *
	 * @return float|object|int|bool|array|string|null
	 * @throws Exception
	 */
	public function getContent(array $criteria): float|object|int|bool|array|string|null
	{
		if ( ! $criteria['channelId']) {
			throw new Exception('channelId doesn`t exists.');
		}

		$params = [
			'channelId' => $criteria['channelId'],
			'maxResults' => $criteria['maxResults'],
		];

		try {
			return $this->youtubeClient()->playlists->listPlaylists('contentDetails,snippet,player,status', $params);
		} catch (Exception $exception) {
			return $exception->getMessage();
		}
	}
}
