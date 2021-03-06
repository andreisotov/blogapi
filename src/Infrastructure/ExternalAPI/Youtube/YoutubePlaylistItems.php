<?php

namespace BlogAPI\Infrastructure\ExternalAPI\Youtube;

use BlogAPI\Infrastructure\Services\Interfaces\ProviderInterface;
use Exception;

class YoutubePlaylistItems implements ProviderInterface
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
		if ( ! $criteria['playlistId']) {
			throw new Exception('playlistId doesn`t exists.');
		}

		$params = [
			'playlistId' => $criteria['playlistId'],
			'maxResults' => 50 ?? $criteria['maxResults'],
		];

		try {
			return $this->youtubeClient()->playlistItems->listPlaylistItems('id,contentDetails,snippet,status', $params);
		} catch (Exception $exception) {
			return $exception->getMessage();
		}
	}
}
