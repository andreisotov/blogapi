<?php

namespace BlogAPI\Infrastructure\ExternalAPI\Youtube;

use BlogAPI\Infrastructure\Services\Interfaces\ProviderInterface;
use Exception;

class YoutubeVideo implements ProviderInterface
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
		if ( ! $criteria['id']) {
			throw new Exception('playlistId doesn`t exists.');
		}

		$params = [
			'id' => $criteria['id'],
		];

		try {
			return $this->youtubeClient()->videos->listVideos('id,contentDetails,snippet,status', $params)[0];
		} catch (Exception $exception) {
			return $exception->getMessage();
		}
	}
}
